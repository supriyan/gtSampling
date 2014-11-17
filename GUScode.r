Join <- function(b1,b2)
{
	b = kronecker(b1, b2, make.dimnames=TRUE)
	n1 = names(b1)
	n2 = names(b2)
	for(i in 1:length(b1))
	{
		for(j in 1:length(b2))
		{
			names(b)[(i-1)*length(b2)+j] = paste(n1[i],n2[j],sep=":")
		}
	}

    return(b)
}

Cross_Product <- function(b1,b2)
{
	b = kronecker(b1, b2, make.dimnames=TRUE)
	n1 = names(b1)
	n2 = names(b2)
	for(i in 1:length(b1))
	{
		for(j in 1:length(b2))
		{
			names(b)[(i-1)*length(b2)+j] = paste(n1[i],n2[j],sep=":")
		}
	}

    return(b)
}

Scan <- function(relation){
b = c(1,1)
names(b)[1] = paste("phi","_",relation,sep="")
names(b)[2] = relation
return(b)
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