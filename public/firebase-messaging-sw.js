
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
   
firebase.initializeApp({
    apiKey: "AIzaSyDyy180oNh48A3EPga0aWuWqf8xIgYlyKI",
    projectId: "selenium-12451",
    messagingSenderId: "1098656685511",
    appId: "1:1098656685511:web:d43b3ca7c306931a32cde2",
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});