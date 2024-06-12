 let slider = document.getElementById('slider');
 let li = slider.getElementsByTagName('li');
 li[0].classList.add("active");
 setInterval(slideActive, 7000);
 function slideActive() {
		  for (let i = 0; i < li.length; i++) {
		     if (li[i].classList.contains("active") && i == li.length-1) {
		          li[i].classList.remove("active");
		          li[0].classList.add("active");
		     } else if (li[i].classList.contains("active")) {
		          li[i].classList.remove("active");
		          i++;
		          li[i].classList.add("active");
			   }
		}
}


let slider2 = document.getElementById('slider2');
let li2 = slider2.getElementsByTagName('li');
li2[0].classList.add("active");
setInterval(slideActive2, 9000);
function slideActive2() {
     for (let i = 0; i < li2.length; i++) {
        if (li2[i].classList.contains("active") && i == li2.length-1) {
             li2[i].classList.remove("active");
             li2[0].classList.add("active");
        } else if (li2[i].classList.contains("active")) {
             li2[i].classList.remove("active");
             i++;
             li2[i].classList.add("active");
        }
   }
}
