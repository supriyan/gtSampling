# Join expression
#   left, right: the left and right expressions
# E.g: Join( Scan("a"), Scan("b") )
#
Join <- function(left, right) {
	return (list(
		ids=c(left$ids, right$ids), 
		b=kronecker(left$b, right$b, make.dimnames=TRUE)
		));
}


# Scan  expression
#   id: the attribute that establishes the identity
#       has to be the long name of the attribute
#       can use relation@attribute
# E.g: Scan(orders@o_orderkey)
#       
Scan <- function(id){
	id <- substitute(id);
	return(list(ids=c(id), b=c(1,1)));
}

GUS <- function(bgus, bip) {
	b = bip*bgus
	a = log(length(bip),base=2)
	a = a - floor(a)
	if(a > 0) 
	{ 
	    stop("The length of b is not a power of 2")	
	}

    if((min(bip) < 0)||(max(bip) > 1))
    {
    	stop("One of the entries of b is not a probability")
    }

	names(b) = names(bip)
    return(b)	
}

Select <- function(b){
	return(b)
}