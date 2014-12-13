\name{GUS}
\alias{GUS}
%- Also NEED an '\alias' for EACH other topic documented here.
\title{
%%  ~~function to do ... ~~
}
\description{
%%  ~~ A concise (1-5 lines) description of what the function does. ~~
}
\usage{
GUS(bgus, bip)
}
%- maybe also 'usage' for other objects documented here.
\arguments{
  \item{bgus}{
%%     ~~Describe \code{bgus} here~~
}
  \item{bip}{
%%     ~~Describe \code{bip} here~~
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
function (bgus, bip) 
{
    b = bip * bgus
    a = log(length(bip), base = 2)
    a = a - floor(a)
    if (a > 0) {
        stop("The length of b is not a power of 2")
    }
    if ((min(bip) < 0) || (max(bip) > 1)) {
        stop("One of the entries of b is not a probability")
    }
    names(b) = names(bip)
    return(b)
  }
}
% Add one or more standard keywords, see file 'KEYWORDS' in the
% R documentation directory.
\keyword{ ~kwd1 }
\keyword{ ~kwd2 }% __ONLY ONE__ keyword per line
