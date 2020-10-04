<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "{{env('ONESIGNAL_APP_ID','')}}",
      subdomainName:"{{env('onesignal_label','')}}",/* The label for your site that you added in Site Setup mylabel.os.tc */
      notifyButton: {
        enable: false,
      },
    });
    OneSignal.setEmail("{{auth()->user()->email}}", {
        emailAuthHash: "{{hash_hmac("sha256", auth()->user()->email, config("services.tawk.api-key"))}}"
    });
   
    OneSignal.showSlidedownPrompt();
  });
</script>