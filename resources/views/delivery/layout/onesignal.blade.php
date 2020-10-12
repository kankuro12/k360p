<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "{{env('ONESIGNAL_APP_ID','')}}",
      @if(!request()->secure())
      subdomainName:"{{env('onesignal_label','')}}",/* The label for your site that you added in Site Setup mylabel.os.tc */
      @endif
      notifyButton: {
        enable: false,
      },
    });
    OneSignal.showSlidedownPrompt();
    console.log('start one signal');
    OneSignal.setEmail("{{auth()->user()->email}}", {
        emailAuthHash: "{{hash_hmac("sha256", auth()->user()->email, config("services.tawk.api-key"))}}"
    });
   
  });
</script>
