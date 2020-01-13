
function additem(data){
  //window.alert(data[0]["item_id"]);
  var parent = document.getElementById('div2');
  var fragment = document.createDocumentFragment();
  for(let i=0; i<data.length; i++){
    let div3 = document.createElement("div");
    let img = document.createElement("img");
    let p1 = document.createElement("p");
    let p2 = document.createElement("p");
    let p3 = document.createElement("p");
    img.id = i;
    img.src = "http://localhost/SQL_HW/images/" + data[i]["item_id"];
    img.onclick = function(){img_click(data[event.target.id]);};
    div3.classList.add("dframe");
    p1.classList.add("textmid");
    p2.classList.add("textmid");
    p3.classList.add("textmid");
    p1.innerText = "商品名稱:" + data[i]["item_name"];
    p2.innerText = "$:" + data[i]["item_price"] + "元";
    p3.innerText = "賣家:" + data[i]["user_name"];
    div3.appendChild(img);
    div3.appendChild(p1);
    div3.appendChild(p2);
    div3.appendChild(p3);
    fragment.appendChild(div3);
  }

  parent.appendChild(fragment);
}

function img_click(data){
  let msg ="訂單資料確認\n \n " + "商品名稱:" + data["item_name"] + "\n 價錢:" + data["item_price"] + "元\n 賣家:" + data["user_name"];
  if(confirm(msg)){
    location.href='index.php?item=' + data["item_type"] + '&item_id=' + data["item_id"];
  }
}
