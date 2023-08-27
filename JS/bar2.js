     document.getElementById("B2cursor1").style.marginLeft = "0px"
        document.getElementById("B2cursor2").style.marginLeft = "200px"
        function B2mooving(id){
            if(moove==id){
                B2moove="None"
            }else{ 
                B2moove=id
            console.log(id+" moove")
            }
        }
        document.getElementById('price').addEventListener('mouseup', function(event) {
            B2moove="None"
            console.log("Souris laché")
            checkprice()
        });


        var posprice1=0
        var posprice2=200
        var B2moove="None"
        document.getElementById('price').addEventListener("mousemove", function(event) {
            console.log("moove")
            launchcursorprice(B2moove)
        }
      )
function launchcursorprice(B2moove){ 
    console.log(B2moove)
      if(B2moove!="None"){ 
        console.log("moove diff of None")
        if(B2moove=="B2cursor1"){
            var div2 = document.getElementById("B2cursor2");
        }else{
            var div2 = document.getElementById("B2cursor1");
        }
        console.log("launchcursord")
        console.log("pos1 : "+posprice1)
        console.log("pos1 : "+posprice2)
        var rect = div2.getBoundingClientRect();

        var mouseX = event.clientX;
        var mouseY = event.clientY;

        var distanceX = mouseX - rect.left - rect.width / 2;
        var distanceY = mouseY - rect.top - rect.height / 2;

        var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
        if(distance<=200){
            if(B2moove=="B2cursor2" && Number(posprice1+distance)>= posprice1){
                var distc1=document.getElementById("B2cursor1").style.marginLeft
                document.getElementById(B2moove).style.marginLeft=(posprice1+distance)+"px"
                posprice2=posprice1+distance  
            }
              
            else if(Number(200-distance)<= posprice2){ 
                var distc1=document.getElementById("B2cursor2").style.marginLeft
                document.getElementById(B2moove).style.marginLeft=(200-distance)+"px"
                posprice1=200-distance
        }
        }
        document.getElementById('B2thumbar').style.width=(posprice2-posprice1)+"px"
        document.getElementById('B2thumbar').style.marginLeft=posprice1+"px"
        console.log("Distance entre la souris et div2 : " + distance + " pixels.");
    }
}


function changeinputprice(){
    console.log('changeinputprice is Working')
    let i1=document.getElementById('minprice1').value
    let i2=document.getElementById('maxprice1').value
    let diff=(maxprice-minprice)/200
    posprice1=i1/diff
    posprice2=i2/diff
    document.getElementById('B2cursor1').style.marginLeft=posprice1+"px"
    document.getElementById('B2cursor2').style.marginLeft=posprice2+"px"
    console.log(diff)
    console.log("posprice1 "+posprice1)
    console.log("posprice2 "+posprice2)
    
    var div1 = document.getElementById('B2cursor1');
    var div2 = document.getElementById('B2cursor2');

    document.getElementById("B2thumbar").style.marginLeft=posprice1+"px"
    document.getElementById("B2thumbar").style.width=(posprice2-posprice1)+"px"
    triprice(i1,i2)
}

var minprice=0
var maxprice=0
var max=0
var min=0
        function checkprice(){
            console.log("minprice = "+minprice)
    var div1 = document.getElementById('B2cursor1');
    var div2 = document.getElementById('B2cursor2');

    var rect1 = div1.getBoundingClientRect();
    var rect2 = div2.getBoundingClientRect();

    var distanceX = rect2.left - rect1.left;
    var distanceY = rect2.top - rect1.top;

    var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
    console.log(distance)
    
    let div1val=parseInt(div1.style.marginLeft, 10)
    let div2val=parseInt(div2.style.marginLeft, 10)

    let diff=(maxprice-minprice)/200



    min=Math.round(div1val*diff)
    console.log("diff = "+div1val*diff)
    console.log(((div2val/200)+1))

    max=Math.round(maxprice-((200-div2val)*diff))
    console.log(minprice)
    
    console.log("maxprice = "+maxprice+" / minprice = "+minprice)
    document.getElementById("minprice1").value=Math.round(min)
    document.getElementById("maxprice1").value=Math.round(max)
    

    triprice(min,max)
}


function minmaxprice(){
    minprice=allcar[0].carPrice
    maxprice=allcar[0].carPrice
    for(i=0;i<allcar.length;i++){
        if(allcar[i].carPrice>maxprice){
            console.log(allcar[i].carPrice)
            maxprice=allcar[i].carPrice
        }else if(allcar[i].carPrice<minprice){
            console.log(allcar[i].carPrice)
            minprice=allcar[i].carPrice
        }
            
    }
    console.log("maxprice = "+maxprice+" / minprice = "+minprice)
    checkprice()
}


