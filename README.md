## Symfony-5 | VueJs 2.6 | Jquery - Buy and Sell Player between Teams
This is a sample Symfony-5 code with following functionality

 - Layout and templating
 - Symfony pagination and custom pagination
 - VueJs operation with API
 - Crud operation for team and player
 - Create bid to sell player with VueJs functions
 - Listing bid and buy player with VueJs functions 
 - Transaction logs with custom pagination

## Installation steps

 - Download zip or clone the repository
 - Set/Configure database settings in .env file
 - Update package by running composer update/install command -- `composer update`
 - Import database from symfony_tasks_1.sql file at root directory OR create fresh tables by running migration command -- `php bin/console doctrine:migrations:migrate`
 - Run the project by command -- `php -S localhost:8000 -t public/`


## Overview 

#Team | Player Crud

 - Crud functions for Team and Player data 
 - Pagination using Symfony pagination library
 - On delete confirm box with sweetalert js and validate if child relational data exist or not
 - Database (Player): Set the relation player may have many bids or transaction and belongs to one Team
 - Database (Team): Set the relation Team have many players, bids or transaction
 - View (Player): https://tinyurl.com/2c35rox3
 - View (Team): https://tinyurl.com/22sv3slp

#Bid/Sell Player

 - Set the team selection page (There is no login functions, so i have set session function for user's current team) 
 - Listing all team player to create bid for sell using VueJs and API
 - Bid View,Edit and Delete option on select team player
 - Use sweetalert js function to display success or error message
 - Database (Bid): Set the relation bid may have many one transaction and belongs to one Team and Player
 - View : https://tinyurl.com/2auljqn9

#Buy/Order Player from bid

 - Set the team selection page (There is no login functions, so i have set session function for user's current team) 
 - Listing all bids using VueJs and API and custom pagination
 - Bid detail and payment screen
 - Show current balance of team and insufficient balance message (If bid price greater than current balance) 
 - On buy player, Bid amount will be debited from buyer team and credited to seller team and player team will be change to buyer
 - View : https://tinyurl.com/27tn4kvo

#Transaction for buy/sell

 - On buy player all balance transfer(Debit/Credit) history will store to transaction table
 - On transaction page it will show all debit/credit history for selected team
 - Custom pagination with limit, offset, total data and current page
 - Database : Set the relation transaction belongs to one Team, Player, and Bid 
 - View : https://tinyurl.com/2av35b4a
 - View (table): https://tinyurl.com/2al8fzld