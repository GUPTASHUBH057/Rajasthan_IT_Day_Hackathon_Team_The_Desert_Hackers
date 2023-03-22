import telegram
import requests
import mysql.connector
from telegram import InlineKeyboardButton, InlineKeyboardMarkup
from telegram.ext import Updater, CallbackQueryHandler, CommandHandler, MessageHandler, Filters

BOT_TOKEN = "put the bot token here"

################################################################
## image hosting

from cloudinary.uploader import upload
from cloudinary.utils import cloudinary_url
import cloudinary

cloudinary.config(
  cloud_name = "Cloud_name_here",
  api_key = "api_key_here",
  api_secret = "api_secret_here",
  secure = True
)

################################################################


################### mysql

mydb = mysql.connector.connect(
  host="your_host_here",
  user="user_name_here",
  password="password_here",
  database="database_name_here"
)

mycursor = mydb.cursor()

s1 = ""
s2 = ""
s3 = ""
s4 = ""
s5 = ""
s6 = ""
s7 = ""
s8 = ""
s9 = ""
s10 = ""
s11 = ""


##############################################################


# Define the start command handler
def start(update, context):
    # Create the initial keyboard with two buttons
    keyboard = [[InlineKeyboardButton("No", callback_data='1'),
                 InlineKeyboardButton("Yes", callback_data='2')]]

    # Create the keyboard markup using the keyboard
    reply_markup = InlineKeyboardMarkup(keyboard)

    # Send the initial message with the keyboard markup
    update.message.reply_text('Do you want to report an incident?', reply_markup=reply_markup)


# def insert_data(data_dict):
#     collection = db["bot_data_collection"]
#     result = collection.insert_one(data_dict)
#     print("Inserted data with ID:", result.inserted_id)
#     print(data_dict)


# Define a function to create the second-level keyboard for option 1
def option1(update, context):
    print("You have chosen not to report an incident.")
    query = update.callback_query
    query.edit_message_text("you have chosen not to report an incident", reply_markup=None)


def option11(update, context):
    print("option 11 is invoked")
    
def option12(update, context):
    print("option 12 is invoked")
    
def option21(update, context):
    print("option 21 is invoked")
    global s1
    s1 = "accident"
    query = update.callback_query
    # query.edit_message_reply_markup(reply_markup=None)
    query.edit_message_text('Please elaborate the incident', reply_markup=None)
    
def option22(update, context):
    global s1
    s1 = "rash_driving"
    query = update.callback_query
    # query.edit_message_reply_markup(reply_markup=None)
    query.edit_message_text('Please elaborate the incident', reply_markup=None)
    
def option23(update, context):
    print("option 23 is invoked")
    global s1
    s1 = "road_rage"
    query = update.callback_query
    # query.edit_message_reply_markup(reply_markup=None)
    query.edit_message_text('Please elaborate the incident', reply_markup=None)
    
def option24(update, context):
    print("option 24 is invoked")
    global s1
    s1 = "public_disturbance"
    query = update.callback_query
    # query.edit_message_reply_markup(reply_markup=None)
    query.edit_message_text('Please elaborate the incident', reply_markup=None)
    
def option25(update, context):
    print("option 25 is invoked")
    global s1
    s1 = "other"
    query = update.callback_query
    # query.edit_message_reply_markup(reply_markup=None)
    query.edit_message_text('Please elaborate the incident', reply_markup=None)
    
def inform_ambul(update, context):
    print("ambulance is informed")
    global s11
    global s10
    s11 = "no"
    s10 = "yes"

    sql = "INSERT INTO bot_data_collection (type_of_incident, uid, description, photo_url, latitude, longitude, pincode, ip_address, informed_to_police, informed_to_ambulance, is_resolved) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
    val = (s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11)
    mycursor.execute(sql, val)

    mydb.commit()
    
    
    query = update.callback_query
    query.edit_message_text('Thanks for being a responsible citizen by reporting the incident.', reply_markup=None)
    
    # data_dict = {}
    
    
def not_inform_ambul(update, context):
    print("ambulance is not informed")
    
    global s11
    global s10
    s11 = "no"
    s10 = "no"
    
    sql = "INSERT INTO bot_data_collection (type_of_incident, uid, description, photo_url, latitude, longitude, pincode, ip_address, informed_to_police, informed_to_ambulance, is_resolved) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
    val = (s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11)
    mycursor.execute(sql, val)

    mydb.commit()
    
    query = update.callback_query
    query.edit_message_text('Thanks for being a responsible citizen by reporting the incident.', reply_markup=None)
    
    # data_dict = {}
    
def inform_police(update, context):
    print('police is informed')
    
    global s9
    s9 = "yes"
    
    # create the keyboard for inform buttons
    keyboard = [[InlineKeyboardButton("Yes", callback_data='inform_ambul_yes'),
                 InlineKeyboardButton("No", callback_data='inform_ambul_no')]]

    # Create the keyboard markup using the keyboard
    reply_markup = InlineKeyboardMarkup(keyboard)

    # # Send the initial message with the keyboard markup
    # update.message.reply_text('Would you like to inform the ambulance?', reply_markup=reply_markup)
    
    query = update.callback_query
    query.edit_message_text('Would you like to inform the ambulance', reply_markup=reply_markup)

    
def not_inform_police(update, context):
    print('police is not informed')
    global s9
    s9 = "no"
    # create the keyboard for inform buttons
    keyboard = [[InlineKeyboardButton("Yes", callback_data='inform_ambul_yes'),
                 InlineKeyboardButton("No", callback_data='inform_ambul_no')]]

    # Create the keyboard markup using the keyboard
    reply_markup = InlineKeyboardMarkup(keyboard)

    # # Send the initial message with the keyboard markup
    # update.message.reply_text('Would you like to inform the ambulance?', reply_markup=reply_markup)
    
    query = update.callback_query
    query.edit_message_text('Would you like to inform the ambulance', reply_markup=reply_markup)


# Define a function to create the second-level keyboard for option 2
def option2(update, context):
    # # Create the second-level keyboard with two buttons
    # keyboard = [[InlineKeyboardButton("Accident", callback_data='2-1'),
    #              InlineKeyboardButton("Rash Drive", callback_data='2-2')]]
    
    keyboard = [[InlineKeyboardButton("Accident", callback_data='2-1'),
                 InlineKeyboardButton("Rash Drive", callback_data='2-2'),
                 InlineKeyboardButton("Road Rage", callback_data='2-3')],
                [InlineKeyboardButton("Public Disturbance", callback_data='2-4'),
                 InlineKeyboardButton("Other", callback_data='2-5')]]

    # Create the keyboard markup using the keyboard
    reply_markup = InlineKeyboardMarkup(keyboard)

    # Send a message with the keyboard
    query = update.callback_query
    query.edit_message_text('Please choose an option:', reply_markup=reply_markup)


    # # Create the keyboard markup using the keyboard
    # reply_markup = InlineKeyboardMarkup(keyboard)

    # # Edit the existing message to show the second-level keyboard
    # query = update.callback_query
    # query.edit_message_text('Please elaborate the incident', reply_markup=reply_markup)

# Define the callback query handler
def button(update, context):
    query = update.callback_query
    choice = query.data

    # Call the appropriate function based on the user's choice
    if choice == '1':
        option1(update, context)
    elif choice == '2':
        option2(update, context)
    elif choice == '2-1':
        option21(update, context)
    elif choice == '2-2':
        option22(update, context)
    elif choice == '2-3':
        option23(update, context)
    elif choice == '2-4':
        option24(update, context)
    elif choice == '2-5':
        option25(update, context)
    elif choice == '1-1':
        option11(update, context)
    elif choice == '1-2':
        option12(update, context)
    elif choice == 'inform_pol_yes':
        inform_police(update, context)
    elif choice == 'inform_pol_no':
        not_inform_police(update, context)
    elif choice == 'inform_ambul_yes':
        inform_ambul(update, context)
    elif choice == 'inform_ambul_no':
        not_inform_ambul(update, context)
        
    
        

# Define a function to handle user messages
def handle_message(update, context):
    message_text = update.message.text
    
    global s3
    s3 = message_text

    user_id = update.message.chat_id
    timestamp = update.message.date
    
    
    global s2
    s2 = str(user_id) + "_" + str(timestamp)
    
    context.bot.send_message(chat_id=update.effective_chat.id, text="Please send photo of the incident")
    

def handle_image(update, context):
    # Get the file ID and download the image
    file_id = update.message.photo[-1].file_id
    
    ## it gives the url of the image on telegram server
    file_path = context.bot.get_file(file_id).file_path
    
    global s4
    s4 = file_path
    
    
    
    update.message.reply_text('Thanks for the image! Now send the location of the incident.')
    

# Define a function to handle location messages
def handle_location(update, context):
    location = update.message.location
    latitude = location.latitude
    longitude = location.longitude
    
    global s5
    global s6
    
    s5 = latitude 
    s6 = longitude
    
    
    rev_geocode_api_key = "rev_geocode_api_here"
    
    geocode_url = f"https://api.opencagedata.com/geocode/v1/json?q={latitude}+{longitude}&key={rev_geocode_api_key}"

    # Send the API request
    response = requests.get(geocode_url)
    
    pincode = ""

    # Parse the API response
    if response.status_code == 200:
        data = response.json()
        if data['total_results'] > 0:
            result = data['results'][0]
            pincode = result['components']['postcode']
        else:
            print("No results found for the given latitude and longitude.")
            pincode = "111111"
    else:
        print("Failed to get response from the API.")
        pincode = "111111"
        
    
    global s7
    global s8
    
    s7 = str(pincode)
    s8 = requests.get('https://ipapi.co/json/').json()['ip']
    
    
    
    
    print("longitude is: ", longitude)
    print("latitude is: ", latitude)
    
    
    
    # Do something with the latitude and longitude coordinates
    update.message.reply_text('Thanks for the location!.')
    
    # create the keyboard for inform buttons
    keyboard = [[InlineKeyboardButton("Yes", callback_data='inform_pol_yes'),
                 InlineKeyboardButton("No", callback_data='inform_pol_no')]]

    # Create the keyboard markup using the keyboard
    reply_markup = InlineKeyboardMarkup(keyboard)

    # Send the initial message with the keyboard markup
    update.message.reply_text('Would you like to inform the police?', reply_markup=reply_markup)
    



# Create the bot and add the handlers

updater = Updater(BOT_TOKEN, use_context=True)

dispatcher = updater.dispatcher

dispatcher.add_handler(CommandHandler('start', start))
dispatcher.add_handler(CallbackQueryHandler(button))
# Create a handler for user messages
message_handler = MessageHandler(Filters.text & (~Filters.command), handle_message)
# Add the message handler to the dispatcher
dispatcher.add_handler(message_handler)

#image handler
dispatcher.add_handler(MessageHandler(Filters.photo, handle_image))

# Register the handler for location messages
location_handler = MessageHandler(Filters.location, handle_location)
dispatcher.add_handler(location_handler)


# Start the bot
updater.start_polling()
