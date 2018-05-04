// import Vue from 'vue';

// import VueRouter from 'vue-router';
// Vue.use(VueRouter);

// import VueAxios from 'vue-axios';
// import axios from 'axios';
// Vue.use(VueAxios, axios);

// import App from './App.vue';
// import Example from './components/ExampleComponent.vue';

// const routes = [
//   {
//       name: 'Example',
//       path: '/',
//       component: Example
//   }
// ];

// const router = new VueRouter({ mode: 'history', routes: routes});
// new Vue(Vue.util.extend({ router }, App)).$mount('#app');




require('./bootstrap');


const app = new Vue({
	el: '#app',
	data: {

		msg: 'Click on user from left side:',
		content: '',
		privateMsgs: [],
		singleMsgs: [],
		msgFrom: '',
		conID: '',
    // userto: '',
		friend_id: '',
   		seen: false,
  		newMsgFrom: ''

	},

ready: function(){
   this.created();

 },

 created(){
 	axios.get('http://localhost:8000/getMessages')
 	.then(response => {
 		console.log(response.data); //show if success
 		app.privateMsgs =response.data; // we are putting data into  our post array
 	})
 	.catch(function (error){
 		console.log(error); //run if we have error
 	});


 },

 // mounted() {
 //    this.messages();
 //        },

 methods:{

  

 	messages: function(id){
 		axios.get('http://localhost:8000/getMessages/' + id)
 	.then(response => {
 		console.log(response.data); //show if success
 		app.singleMsgs =response.data; // we are putting data into  our post array
 		app.conID = response.data[0].conversation_id;
    // app.userto = response.data[0].id
    // $('textarea').val('');
 	})
 	.catch(function (error){
 		console.log(error); //run if we have error
 	});
 	},

  

 	inputHandler(e){
 		if(e.keyCode ===13 && !e.shiftKey){
 			e.preventDefault();
 			this.sendMsg();

      return false;


 		}
 	},

 	sendMsg(){
 		if(this.msgFrom){
 			// alert(this.conID);
 			// alert(this.msgFrom);

 			 axios.post('http://localhost:8000/sendMessage', {
              conID: this.conID,
              msg: this.msgFrom
            })
           .then(function (response) {              
              console.log(response.data); // show if success
              if(response.status===200){
                app.singleMsgs = response.data;
                
                console.log('Reached this point');
                $('textarea').val('');

              }

            })

            .catch(function (error) {
              console.log(error); // run if we have error
            });

 		}
    this.msgFrom = "";
 	},


 	friendID: function(id){
     app.friend_id = id;
   },

   sendNewMsg(){
     axios.post('http://localhost:8000/sendNewMessage', {
            friend_id: this.friend_id,
            msg: this.newMsgFrom,
          })
          .then(function (response) {
            console.log(response.data); // show if success
            if(response.status===200){
              window.location.replace('http://localhost:8000/messages');
              app.msg = 'your message has been sent successfully';
            }

          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
   }


 }


});


// // Create vue router
//     var router = new VueRouter({
//         mode: 'history',
//         routes: [
//              {
//                 name: 'getMessages',
//                 path: '/:id',
//                 component: app
//             }
//         ]
//     });

//     // Create vue instance with our router, and mount onto #app
//     var vue = new Vue({router});
//     var app1 = vue.$mount('#app1')