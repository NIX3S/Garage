

     document.getElementById("cursor1").style.marginLeft = "0px"
        document.getElementById("cursor2").style.marginLeft = "200px"
        function mooving(id){
            if(moove==id){
                moove="None"
            }else{ 
                moove=id
            console.log(id+" moove")
            }
        }
        min=document.getElementById('min1').value
            max=document.getElementById('max1').value

        document.getElementById('km').addEventListener('mouseup', function(event) {
            moove="None"
            console.log("Souris laché Oui")
            checkkm()
            
        });
        var pos1=0
        var pos2=200
        var moove="None"
        document.getElementById('km').addEventListener("mousemove", function(event) {
            console.log("moove")
            launchcursor(moove)
        }
      )
function launchcursor(moove){ 
    
      if(moove!="None"){ 
        if(moove=="cursor1"){
            var div2 = document.getElementById("cursor2");
        }else{
            var div2 = document.getElementById("cursor1");
        }
        console.log("launchcursord")
        console.log("pos1 : "+pos1)
        console.log("pos1 : "+pos2)
        var rect = div2.getBoundingClientRect();

        var mouseX = event.clientX;
        var mouseY = event.clientY;

        var distanceX = mouseX - rect.left - rect.width / 2;
        var distanceY = mouseY - rect.top - rect.height / 2;

        var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
        if(distance<=200){
            if(moove=="cursor2" && Number(pos1+distance)>= pos1){
                var distc1=document.getElementById("cursor1").style.marginLeft
                document.getElementById(moove).style.marginLeft=(pos1+distance)+"px"
                pos2=pos1+distance  
            }
              
            else if(Number(200-distance)<= pos2){ 
                var distc1=document.getElementById("cursor2").style.marginLeft
                document.getElementById(moove).style.marginLeft=(200-distance)+"px"
                pos1=200-distance
        }
        }
        document.getElementById('thumbar').style.width=(pos2-pos1)+"px"
        document.getElementById('thumbar').style.marginLeft=pos1+"px"
        console.log("Distance entre la souris et div2 : " + distance + " pixels.");
    }
}


function changeinputkm(){
    console.log('changeinputkm is Working')
    let i1=document.getElementById('min1').value
    let i2=document.getElementById('max1').value
    let diff=(maxkm-minkm)/200
    pos1=i1/diff
    pos2=i2/diff
    document.getElementById('cursor1').style.marginLeft=pos1+"px"
    document.getElementById('cursor2').style.marginLeft=pos2+"px"
    console.log(diff)
    console.log("pos1 "+pos1)
    console.log("pos2 "+pos2)
    
    var div1 = document.getElementById('cursor1');
    var div2 = document.getElementById('cursor2');

    document.getElementById("thumbar").style.marginLeft=pos1+"px"
    document.getElementById("thumbar").style.width=(pos2-pos1)+"px"
    trikm(i1,i2)
}

var minkm=0
var maxkm=0
var max=0
var min=0
        function checkkm(){
            console.log("minkm = "+minkm)
    var div1 = document.getElementById('cursor1');
    var div2 = document.getElementById('cursor2');

    var rect1 = div1.getBoundingClientRect();
    var rect2 = div2.getBoundingClientRect();

    var distanceX = rect2.left - rect1.left;
    var distanceY = rect2.top - rect1.top;

    var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
    console.log(distance)
    
    let div1val=parseInt(div1.style.marginLeft, 10)
    let div2val=parseInt(div2.style.marginLeft, 10)

    let diff=(maxkm-minkm)/200



    min=Math.round(div1val*diff)
    console.log("diff = "+div1val*diff)
    console.log(((div2val/200)+1))

    max=Math.round(maxkm-((200-div2val)*diff))
    console.log(minkm)
    
    console.log("maxkm = "+maxkm+" / minkm = "+minkm)
    document.getElementById("min1").value=Math.round(min)
    document.getElementById("max1").value=Math.round(max)
    

    trikm(min,max)
}


function minmaxkm(){
    minkm=allcar[0].kilometer
    maxkm=allcar[0].kilometer
    for(i=0;i<allcar.length;i++){
        if(allcar[i].kilometer>maxkm){
            console.log(allcar[i].kilometer)
            maxkm=allcar[i].kilometer
        }else if(allcar[i].kilometer<minkm){
            console.log(allcar[i].kilometer)
            minkm=allcar[i].kilometer
        }
            
    }
    console.log("maxkm = "+maxkm+" / minkm = "+minkm)
    checkkm()
}