# Permet d'installer les packages non installés
my_packages = c("shiny", "ggplot2","DT","dplyr","lubridate","shinythemes")

install_if_missing = function(p) {
  if (p %in% rownames(installed.packages()) == FALSE) {
    install.packages(p)
  }
}

invisible(sapply(my_packages, install_if_missing))
