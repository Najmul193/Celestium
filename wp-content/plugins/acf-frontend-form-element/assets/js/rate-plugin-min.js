!function(t){t(document).ready((function(){var a=t(".fea-rate-action");a.length&&a.find("a").click((function(n){n.preventDefault(),a.remove();var r=t(this).attr("data-rate-action"),e=t(this).attr("data-href");if(t.post(fa.ajaxurl,{action:"fea-rate-plugin",rate_action:r,_n:a.find("ul:first").attr("data-nonce")}),"do-rate"!==r)return!1;window.open(e,"_blank")}))}))}(jQuery);