<?php

/* 
 * Generator for GUS variance analysis
 *
 * Template arguments: 
 *   [R]  'inputs':   the inputs, in order of the companion GUS GLA
 *                    The last input is the aggregate
 *   [R]  'bcoeff':   The bcoefficients                 
 *
 * This resrouce assumes that the error checking is performed by the GUS GLS
 */ 


function GeneralizedSamplingEstimate($t_args){

	$inputs = $t_args['inputs'];
	$indexedI = array_values($inputs); // used to number the elements
	$k = count($inputs) -1;

	$bcoeff = $t_args['bcoeff'];
	$name = generate_name('GeneralizedSamplingEstimate');
?>	

	class <?=$name?> {
		public:
		struct Tuple {
			public: // might need direct access to members
			static const int k = <?=count($inputs)-1?>;

		<? foreach( $inputs as $name => $type ) { ?>
			<?=$type?> <?=$name?>;
		<?  } ?>

		<?  if( $debug > 0 ) { ?>
			friend ostream& operator<<(ostream& Ostr, const mytuple& Tup) {
				Ostr <<"( ";
			<? foreach( $inputs as $name => $type ) { ?>
				Ostr << Tup.<?=$name?> << ", ";
			<?  } ?>
			    Ostr << endl;
			    return Ostr;
			}
		<?  } // debug > 0 ?>	

			uint64_t Hash() const {
				uint64_t hash=HASH_INIT_MOD;
			<? for ($i = 0; $i < $k; $i++) { ?>
				if ((order & (1 << <?=$i?>)) != 0) {
					hash = CongruentHashModified(<?=$indexedI[$i]?>,hash);
				}
			<? } ?>
				return hash;
			}

			bool operator==(const mytuple& o) const {
			<? for ($i = 0; $i < $k; $i++) { ?>
				if ((order & (1 << <?=$i?>)) != 0) {
					if (<?=$indexedI[$i]?> != o.<?=$indexedI[$i]?>)
						return false;
				}
			<? } ?>
				return true;
			}

			bool operator<(const mytuple& o) const {
			<? for ($i = 0; $i < $k; $i++) { ?>
				if ((order & (1 << <?=$i?>)) != 0) {
					if (<?=$indexedI[$i]?> < o.<?=$indexedI[$i]?>)
					    return true;
                }
            <? } ?>
                return false;
            }
        };

        struct HashKey {
        	size_t operator() (const Tuple& o) const {
        		return o.Hash();
        	}
        };

        public:
           /*a - scaling factor for expected value                                                                                                                                                                                                    
            It accounts for the outside computed GUS +                                                                                                                                                                                               
            the bernoullli subsampling.                                                                                                                                                                                                              
           */
           double a;
           double a_sub;

           /*b_t - coefficients for the variance terms                                                                                                                                                                                                
             They accounts for the outside computed GUS +                                                                                                                                                                                             
             the bernoullli subsampling.                                                                                                                                                                                                              
           */
           double b_t[1 << <?=k?>];
           double b_t_sub[1 << <?=k?>];

           std::vector< Tuple >& V; // the set of tuples we are working on

           /*biased y_s - the raw summations obtained from the data*/
           double coefficients[1 << <?=k?>];

           /*unbiased Y_s - computed from y_s*/
           double unbiased_coefficients[1 << <?=k?>];

           /*Array indicating whether the the unbiased Y_s has been computed for a particualr s */
           int is_unbiased_computed[1 << <?=k?>];


           double expectation_estimate;

           int tuples_in;
           int is_variance_stable;
           int deletes_no;
           int tuples_stable;

           /* General constructor for outside computed GUS */
           /* Takes the a & b_t parameters for the outside computed GUS and */
           /* combines them with the bernoulli subsampling parameters to get the */
           /* ultimate a & b_t parameters*/
           /* Note: If there has been no subsampling, then the bernoulli parameters are all 1*/
           /* and the ultimate parameters are equal to the input parameters*/

           GeneralizedSamplingData(int numR, double _a, double* _b, double p, std::vector<Tuple>& _V) 
           : a(_a), V(_V) {
           	   

           }

	};
<?

return [
		'kind'				=> 'RESOURCE',
		'name'				=> $name,
		'system_headers'	=> ['vector', 'algorithms', 'unordered_map'],
		'libraries'			=> [],
		'mutable'			=> true
	];
}
?>