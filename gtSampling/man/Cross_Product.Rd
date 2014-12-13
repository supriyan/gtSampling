\name{Cross_Product}
\alias{Cross_Product}
%- Also NEED an '\alias' for EACH other topic documented here.
\title{
%%  ~~function to do ... ~~
}
\description{
%%  ~~ A concise (1-5 lines) description of what the function does. ~~
}
\usage{
Cross_Product(b1, b2)
}
%- maybe also 'usage' for other objects documented here.
\arguments{
  \item{b1}{
%%     ~~Describe \code{b1} here~~
}
  \item{b2}{
%%     ~~Describe \code{b2} here~~
}
}
\details{
%%  ~~ If necessary, more details than the description above ~~
}
\value{
%%  ~Describe the value returned
%%  If it is a LIST, use
%%  \item{comp1 }{Description of 'comp1'}
%%  \item{comp2 }{Description of 'comp2'}
%% ...
}
\references{
%% ~put references to the literature/web site here ~
}
\author{
%%  ~~who you are~~
}
\note{
%%  ~~further notes~~
}

%% ~Make other sections like Warning with \section{Warning }{....} ~

\seealso{
%% ~~objects to See Also as \code{\link{help}}, ~~~
}
\examples{
##---- Should be DIRECTLY executable !! ----
##-- ==>  Define data, use random,
##--	or do  help(data=index)  for the standard data sets.

## The function is currently defined as
function (b1, b2) 
{
    b = kronecker(b1, b2, make.dimnames = TRUE)
    n1 = names(b1)
    n2 = names(b2)
    for (i in 1:length(b1)) {
        for (j in 1:length(b2)) {
            names(b)[(i - 1) * length(b2) + j] = paste(n1[i], 
                n2[j], sep = ":")
        }
    }
    return(b)
  }
}
% Add one or more standard keywords, see file 'KEYWORDS' in the
% R documentation directory.
\keyword{ ~kwd1 }
\keyword{ ~kwd2 }% __ONLY ONE__ keyword per line
