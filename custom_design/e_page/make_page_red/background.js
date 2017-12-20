var node = document.createElement("a"); 
var textnode = document.createTextNode("This is first Product!!"); 
node.href = "http://freedomforjobs.com";
node.appendChild(textnode); 

document.getElementsByClassName("top")[0].appendChild(node); 

var link = document.createElement("a");
//link.appendChild(document.createTextNode("Anchor"));
link.href = "http://google.com";
link.alt = "Flash and JS are not enemies!";
var img = document.createElement("img");
img.src = "https://chaldal.com/favicon.ico?v=1";
link.appendChild(img);
document.body.appendChild(link); 

document.getElementsByClassName("top")[1].appendChild(link);


var node1 = document.createElement("a");
var textnode1 = document.createTextNode("Monim hossain can!!!");
node1.href = "http://youtube.com";
node1.appendChild(textnode1);

document.getElementsByClassName("top")[2].appendChild(node1);