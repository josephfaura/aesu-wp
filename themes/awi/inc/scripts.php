<script>
	function getParentAnchor(el, tag) {
    while (el.parentNode) {
      el = el.parentNode;
      if (el.tagName === tag) {
        var alpha = el.nodeName;
        var bravo = el.href;
        return [alpha, bravo];
      }
    }
    return ['', ''];
  }

  var body = document.querySelector("body");

  body.addEventListener("click", function(e) {
    var targetTag = e.target.nodeName;
    var targetHref = e.target.href;

    if (targetTag !== "A") {
      targetTag = getParentAnchor(e.target, "A")[0];
      targetHref = getParentAnchor(e.target, "A")[1];
    }

    if (targetTag === "A" && targetHref.search("tel") === 0) {
      e.preventDefault();
      var phoneNum = targetHref.replace("tel:", "");
      console.log('clicked');
      gtag("event","call", {
        'phoneNum' : phoneNum,
        'event_callback': function() {
          window.location = 'tel:' + phoneNum;
          console.log('sent');
        }
      });
    }
  });
</script>