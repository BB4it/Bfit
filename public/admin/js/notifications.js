$(document).ready(function() {
   // var list_count = $('#number_notification').children().length;
   //  console.log(list_count);
   //  document.getElementById('mySpan_notification').innerHTML = list_count;
   //  document.getElementById('mySpan_notification1').innerHTML = list_count;
   //  $("#number_notification").empty();
});
// $(function () {
//     // get message from firebase
//     messageRef.limitToLast(10).on('child_added', function (snapshot) {
//         var data             = snapshot.val();
//         var message          = data.message;
//         var sender_id        = data.sender_id;   //58
//         var receiver_id      = data.receiver_id;  //10
//         var inbox_id         = data.inbox_id;
//
//
//     });
//
//
//
// });



firebase.database().ref("notifications").limitToLast(5).on('value', snapshot => {
    $("#number_notification").empty();
    snapshot.forEach(snap => {
      var url = "{{ url('/') }}";
      if (snap.val().bank == 1){
          console.log(snap.val().user_id);
          $("#number_notification").prepend('<li><a href="'+'/admin/banktransfer'+'"><span class="details"><span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>'+' بتحويل بنكي للاعلان ' + snap.val().user_name +' قام '+'</span></a></li>');

      }
      if(snap.val().comment == 1){
          console.log(snap.val().user_id);
          $("#number_notification").prepend('<li><a href="'+'/admin/reports/badcomment'+'"><span class="details"><span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>'+' بالتبليغ عن تعليق ' + snap.val().user_name +' قام '+'</span></a></li>');

      }
      if(snap.val().ad == 1){
          console.log(snap.val().user_id);
          $("#number_notification").prepend('<li><a href="'+'/admin/reports/badads'+'"><span class="details"><span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>'+' بالتبليغ عن اعلان ' + snap.val().user_name +' قام '+'</span></a></li>');

      }
      if(snap.val().contact == 1){
          console.log(snap.val().user_id);
          $("#number_notification").prepend('<li><a href="'+'/admin/reports/badads'+'"><span class="details"><span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>'+' بارسال رسالة ' + snap.val().user_name +' قام '+'</span></a></li>');

      }



    });

    // var list_count = $('#number_notification').children().length;
    // console.log(list_count);
    // document.getElementById('mySpan_notification').innerHTML = list_count;
    // document.getElementById('mySpan_notification1').innerHTML = list_count;


    var count = 0;

    firebase.database().ref('notifications').on("value", function(snapshot) {
        // console.log("added:", snap.val().watch);
        snapshot.forEach(snap => {
            if (snap.val().watch === 0){
                count++;

            }

        });

        if (count !== 0){
            document.getElementById('mySpan_notification').innerHTML = count;
            document.getElementById('mySpan_notification1').innerHTML = count;

        }

    });

});


