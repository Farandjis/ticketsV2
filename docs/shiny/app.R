library(shiny) #  Pour créer des applications web interactives en R.
library(ggplot2) # Pour la création de graphiques.
library(DT) # Pour afficher des tables de données interactives.
library(dplyr) # Pour effectuer des manipulations de données.
library(lubridate) # Pour travailler avec les dates.
library(shinythemes) # Pour appliquer des thèmes à votre application Shiny.


# Fonctions de calcule
moy1 = function(a){
  return(sum(a)/length(a))
}

var1=function(a){
  return(moy1(a^2)-moy1(a)^2)
}

sd1=function(a){
  return(sqrt(var1(a)))
}

# Générer des dates aléatoires dans la plage spécifiée
plage_dates <- seq(ymd_hms("2022-01-01 00:00:00"), by = "days", length.out = 740)

dates_aleatoires <- sample(plage_dates, 1000, replace = TRUE)

# Génération de tickets totalements fictifs pour une simulation avec un grand nombre de ticket
data <- data.frame(
  ID_TICKET = 1:2000,
  ID_USER = sample(1:10, 1000, replace = TRUE),
  TITRE_TICKET = sample(c("[SESSION] Autre problème", "[SALLE] Problème de la salle", "[MATERIEL] Matériel manquant", "[MATERIEL] Autre problème", "[LOGICIEL] Proposition de logiciel", "[LOGICIEL] Problème de logiciel", "[LOGICIEL] Autre problème", "[!] Autre problème"), 1000, replace = TRUE),
  DESCRIPTION_TICKET = sample(c("Problème de connexion", "Problème matériel", "Problème logiciel"), 1000, replace = TRUE),
  ID_TECHNICIEN = sample(c(1, 2, 3, 4, 5), 1000, replace = TRUE),
  NIV_URGENCE_ESTIMER_TICKET = sample(c("Faible", "Moyen", "Urgent"), 1000, replace = TRUE),
  NIV_URGENCE_DEFINITIF_TICKET = sample(c("Faible", "Moyen", "Urgent", "Non complété"), 1000, replace = TRUE),
  ETAT_TICKET = sample(c("En attente", "Ouvert", "En cours de traitement", "Fermé"), 1000, replace = TRUE),
  HORODATAGE_CREATION_TICKET = dates_aleatoires,
  HORODATAGE_DEBUT_TRAITEMENT_TICKET = sample(c(NA, seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200)), 1000, replace = TRUE),
  HORODATAGE_RESOLUTION_TICKET = sample(c(NA, seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200)), 1000, replace = TRUE),
  HORODATAGE_DERNIERE_MODIF_TICKET = seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200),
  ID_USER_DERNIERE_MODIF_TICKET = sample(1:10, 1000, replace = TRUE)
)

# Convertion des dates en objets de classe POSIXct. Ce sont des objets qui représentent des dates et heures dans R.
data$HORODATAGE_CREATION_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$HORODATAGE_DEBUT_TRAITEMENT_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$HORODATAGE_RESOLUTION_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$ID_USER_DERNIERE_MODIF_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)

# Extraire le mois et l'année à partir de la colonne HORODATAGE_CREATION_TICKET

# Utilisation de l'opérateur %>% (pipe) pour chaîner les opérations
# Il transmet le résultat de la gauche vers la droite, améliorant la lisibilité du code.
data <- data %>%
  mutate(Mois = format(HORODATAGE_CREATION_TICKET, "%B"),
         Année = format(HORODATAGE_CREATION_TICKET, "%Y"))


# Définir l'interface utilisateur (UI)  ================================================================================================================
ui <- fluidPage(theme = shinytheme("yeti"),
                navbarPage(
                  "TIX probas/stats",
                  
                  tags$head(
                    tags$style(HTML("
                                    body {
                                      margin-top: 0; /* Ajoute une marge en haut de 100 pixels */
                                    }
                                    
                                    .centered-title {
                                      text-align: center;
                                    }
                                    #moyenne_ticket{
                                    color : blue;
                                    }
                                    #mediane_ticket{
                                    color : orange;
                                    }
                                    #sd_ticket{
                                    color : red;
                                    }
                                  "))
                  ),
                  
                  
                  tags$div(
                    style = "position: fixed; bottom: 0; width: 100%; background-color: #f8d7da; color: #721c24; text-align: center; padding: 10px;",
                    "Ces informations sont fictives et peuvent contenir des incohérences. Ne les utilisez pas concrètement."
                  ),
                  
                  # Première page
                  tabPanel("Table",
                           fluidPage(
                             
                             div(class = "centered-title", titlePanel("Table des tickets")),
                             fluidRow(
                               column(4,
                                      selectInput("titre",
                                                  "Titre de ticket:",
                                                  c("All", unique(as.character(data$TITRE_TICKET))))
                               ),
                               column(4,
                                      selectInput("etat",
                                                  "Etat de ticket:",
                                                  c("All", unique(as.character(data$ETAT_TICKET))))
                               ),
                               column(4,
                                      selectInput("idtech",
                                                  "Identifiant du technicien:",
                                                  c("All", unique(as.character(data$ID_TECHNICIEN))))
                               )
                             ),
                             DT::dataTableOutput("table"),
                             br(),br(),br()
                           )
                  ),
                  
                  # Deuxième page
                  tabPanel("Stat nombre Ticket",
                           fluidPage(
                             div(class = "centered-title", titlePanel("Analyse du nombre de ticket sur la plateforme")),
                             # Ajoutez ici votre code pour la visualisation (graphiques, etc.)
                             
                             sidebarLayout(
                               sidebarPanel(
                                 dateRangeInput("dates", h3("Période : "), start = "2022-01-01"),
                                 
                                 checkboxGroupInput("checkEtat", h3("Sélection Etat ticket :"), 
                                                    choices = c("En attente", "Ouvert", "En cours de traitement", "Fermé"), selected = c("En attente", "Ouvert", "En cours de traitement", "Fermé")),
                                 
                                 checkboxGroupInput("checkGroup", 
                                                    h3("Sélection de statistique :"), 
                                                    choices = c("Moyenne", "Mediane", "Écart type")),
                                 
                                 actionButton("reset_button", "Réinitialiser")
                               ),
                               mainPanel(
                                 plotOutput("bar_chart"),
                                 textOutput("total_row"),
                                 textOutput("moyenne_ticket"),
                                 textOutput("mediane_ticket"),
                                 textOutput("sd_ticket")
                               )
                             )
                           )
                  )
                ))


# Définir le serveur ===================================================================================================================================
server <- function(input, output, session) {
  
  # Filtrer les données en fonction des sélections de l'utilisateur
  output$table <- DT::renderDataTable({
    data_filtrees <- data
    if (input$titre != "All") {
      data_filtrees <- data_filtrees[data_filtrees$TITRE_TICKET == input$titre,]
    }
    if (input$idtech != "All") {
      data_filtrees <- data_filtrees[data_filtrees$ID_TECHNICIEN == input$idtech,]
    }
    if (input$etat != "All") {
      data_filtrees <- data_filtrees[data_filtrees$ETAT_TICKET == input$etat,]
    }
    DT::datatable(data_filtrees)
  })
  
  # Fonction pour générer le DataFrame réactif
  generate_data <- reactive({
    start_date <- input$dates[1]
    end_date <- input$dates[2]
    
    data %>%
      filter(!is.na(Mois) & !is.na(Année) & 
               between(HORODATAGE_CREATION_TICKET, start_date, end_date) &
               ETAT_TICKET %in% input$checkEtat) %>%
      
      group_by(Mois, Année) %>%
      summarise(Count = n(),  .groups = 'drop')
  })
  
  # Fonction pour générer et afficher le diagramme en temps réel
  output$bar_chart <- renderPlot({
    
    gg <- ggplot(generate_data(), aes(x = Mois, y = Count, fill = factor(Année))) +
      geom_bar(stat = "identity", position = "dodge") +
      geom_text(aes(label = Count), position = position_dodge(width = 1), vjust = -0.5) +
      labs(title = "Nombre de Tickets par Mois et Année")
    
    if ("Moyenne" %in% input$checkGroup) {
      moyenne_total_tickets <- moy1(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = moyenne_total_tickets, color = "blue")
    }
    
    if ("Mediane" %in% input$checkGroup) {
      mediane_total_tickets <- median(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = mediane_total_tickets, color = "orange")
    }
    
    if ("Écart type" %in% input$checkGroup) {
      sd_total_tickets <- sd1(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = sd_total_tickets, color = "red")
    }
    
    print(gg)
  })
  
  output$total_row <- renderText({
    text <- ""
    nombre_total_tickets <- sum(generate_data()$Count)
    text <- paste(text, paste("Nombre total de tickets sélectionné : ", nombre_total_tickets))
  })
  
  
  output$moyenne_ticket <- renderText({
    text <- ""
    
    if ("Moyenne" %in% input$checkGroup) {
      moyenne_total_tickets <- moy1(generate_data()$Count)
      text <- paste(text, paste("Moyenne : ", round(moyenne_total_tickets, 2), id = "moyenne_ticket"))
    }
    
    return(text)
  })
  output$mediane_ticket <- renderText({
    text <- ""
    
    if ("Mediane" %in% input$checkGroup) {
      mediane_total_tickets <- median(generate_data()$Count)
      text <- paste(text, paste("Médiane : ", round(mediane_total_tickets, 2)), id = "mediane_ticket")
    }
    
    return(text)
  })
  
  output$sd_ticket <- renderText({
    text <- ""
    
    if ("Écart type" %in% input$checkGroup) {
      sd_total_tickets <- sd1(generate_data()$Count)
      text <- paste(text, paste("Écart type : ", round(sd_total_tickets, 2)), id = "sd_ticket")
    }
    
    return(text)
  })
  
  # Observer le bouton reset_button pour réinitialiser les inputs
  observeEvent(input$reset_button, {
    updateDateRangeInput(session, "dates", start = "2022-01-01", end = format(Sys.Date(), "%Y-%m-%d"))
    updateCheckboxGroupInput(session, "checkEtat", selected = c("En attente", "Ouvert", "En cours de traitement", "Fermé"))
    updateCheckboxGroupInput(session, "checkGroup", selected = character(0))
  })
}

# Lancer l'application
shinyApp(ui, server)
