require('./bootstrap');

var channel = Echo.private(`App.Models.User.${userID}`);
channel.notification(function(data) {
    // alert(JSON.stringify(data));
    console.log('fdssdf')
});
