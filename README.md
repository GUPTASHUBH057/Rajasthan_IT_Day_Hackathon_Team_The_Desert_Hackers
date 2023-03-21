# Rajasthan_IT_Day_Hackathon_Team_The_Desert_Hackers
A system for mitigating road safety issues. 

# The presentation for this system can be found on this link :
https://docs.google.com/presentation/d/1Ik0fW6qT8G9LD3ZSP9VN53f50McdtyOgFIa2jf1FQrU/edit?usp=sharing

This system consists of 2 modules.

The first one is a telegram bot. This bot is a means for the citizen to register about different road safety related incidents. It takes the location, description of the scenario, exact location and other inputs and stores the data in a MySQL database. Also it asks if the citizen wants to immediately inform the police and ambulance.

The second module is a PHP based web application. It is a web app where the authorities such as police can keep track of all the incidents reported and view them, classify them in resolved or not resolved, view the information shared by the citizens. There are 2 possibilities for authorities. The first level is Admin status, which has all the rights and can see all the data. The second level is officer level, they can see limited amount of data. For example they can't see the IP address of the citizen who has reported the incident, but the Admin can see it. Moreover each officer has its associated entry in a different table in the database, where the login id, password and corresponding area's pincode and designation is there. Based on their alloted pincode, the officer level authorities can only see the incidents reported in their respective pincode areas. The Admin level authoritied can view the incidents reported on all the pincodes.


How to use this system:

1. The telegram bot has a Python file named as "bot_mysql.py" which is located here in "bot_code" folder. It need a unique bot token, any developer who wants to modify it needs to have his own bot token, which can be generated using Telegram app. 
Also there are some other APIs used, corresponding API Keys need to be generated as well, before the file is run.
To run the bot all the Python modules which are required also need to be imported and then the bot can be started.

This bot will collect the data and store it in the Database as discussed before.

2. Now the Web App part, it is PHP based web app, which the authorities can use to manage and take appropriate steps. It is a standard PHP web app which uses the same database which was used by the bot to store the data.




