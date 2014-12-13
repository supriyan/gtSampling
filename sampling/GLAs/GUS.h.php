 <?

 /* This GLA maintains a subsample of the data
  *
  * The input order has to be id1, id2, ..., idn, aggregate
  * This GLA determines how many relations are covered from the 
  * number of input arguments.
  * 
  * Template Arguments
  *
  *   [R] 'bcoeff':     Array of Doubles. These are the b_T coefficients in 
  *                     EXACTLY the 2^n order of the id's
  *   [O] 'lowerLimit'  The minimum number of tuples to keep in the state
  *                     Defaults to 100,000
  *   [O] 'upperLimit'  The maximum number of tuples to keep in the state
  *                     Defaults to 400,000
  *   [O] 'debug'       1=TRUE, 0=FALSE. If true, debugg info will be printed. 
  *                     Defaults to FALSE
 */ 

function GLA( array $t_args, array $inputs, array $outputs ) {

	// number of relations
	$N = count($inputs) -1 ;

    grokit_assert( array_key_exists('bcoeff', $t_args), 'bcoeff not specified for GUS GLA');
    $bcoeff = $t_args['bcoeff'];
    grokit_assert( count($bcoeff) == pow(2, N), 'size of bcoeff coefficient is not 2^#relations');

    // limits. Set to defaults if missing 
    $lowerLimit = get_default( $t_args, 'lowerLimit', 100000);
    $upperLimit = get_default( $t_args, 'upperLimit', 400000);

    $className = generate_name('GUS');
    $debug = get_default( $t_args, 'debug', 0 );

    $outputs['expectation'] = lookupType('base::DOUBLE');
    $outputs['variance'] = lookupType('base::DOUBLE');

    // instantiate the variance computator
    $estimator = lookupResource('base::BernoulliSampleState',
		['inputs' => $inputs, 'bcoeff' => $bcoeff, 'debug' => $debug);
?>

	class <?=$className?> {
		typedef <?=$estimator?>::Tuple Tuple;
		


	};

<?
 $system_headers = [ 'vector', 'algorithm', 'cinttypes', 'unordered_map' ];
    if( $debug > 0 ) {
        $system_headers = array_merge($system_headers, [ 'iostream', 'sstream', 'string' ] );
    }
    return array(
        'kind'           => 'GLA',
        'name'           => $className,
        'input'          => $inputs,
        'output'         => $outputs,
        'result_type'    => 'single',
        'system_headers' => $system_headers,
    );

} // end of function GLA
?>