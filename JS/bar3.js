     document.getElementById("B3cursor1").style.marginLeft = "0px"
        document.getElementById("B3cursor2").style.marginLeft = "200px"
        function B3mooving(id){
            if(B3moove==id){
                B3moove="None"
            }else{ 
                B3moove=id
            console.log(id+" moove")
            }
        }
        document.getElementById('year').addEventListener('mouseup', function(event) {
            B3moove="None"
            console.log("Souris laché3")
            checkyear()
            
        });
        var posyear1=0
        var posyear2=200
        var B3moove="None"
        document.getElementById('year').addEventListener("mousemove", function(event) {
            console.log("moove")
            launchcursoryear(B3moove)
        }
      )
function launchcursoryear(B3moove){ 
    
      if(B3moove!="None"){ 
        if(B3moove=="B3cursor1"){
            var div2 = document.getElementById("B3cursor2");
        }else{
            var div2 = document.getElementById("B3cursor1");
        }
        console.log("launchcursord")
        console.log("pos1 : "+posyear1)
        console.log("pos1 : "+posyear2)
        var rect = div2.getBoundingClientRect();

        var mouseX = event.clientX;
        var mouseY = event.clientY;

        var distanceX = mouseX - rect.left - rect.width / 2;
        var distanceY = mouseY - rect.top - rect.height / 2;

        var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
        if(distance<=200){
            if(B3moove=="B3cursor2" && Number(posyear1+distance)>= posyear1){
                var distc1=document.getElementById("B3cursor1").style.marginLeft
                document.getElementById(B3moove).style.marginLeft=(posyear1+distance)+"px"
                posyear2=posyear1+distance  
            }
              
            else if(Number(200-distance)<= posyear2){ 
                var distc1=document.getElementById("B3cursor2").style.marginLeft
                document.getElementById(B3moove).style.marginLeft=(200-distance)+"px"
                posyear1=200-distance
        }
        }
        document.getElementById('B3thumbar').style.width=(posyear2-posyear1)+"px"
        document.getElementById('B3thumbar').style.marginLeft=posyear1+"px"
        console.log("Distance entre la souris et div2 : " + distance + " pixels.");
    }
}


function changeinputyear(){
    console.log('changeinputyear is Working')
    let i1=document.getElementById('minyear1').value
    let i2=document.getElementById('maxyear1').value
    console.log("year :"+ maxyear + " : "+minyear)
    let diff=(maxyear)/200
    posyear1=(i1/minyear)*diff
    posyear2=i2/diff
    document.getElementById('B3cursor1').style.marginLeft=posyear1+"px"
    document.getElementById('B3cursor2').style.marginLeft=posyear2+"px"
    console.log(diff)
    console.log("pos1 "+posyear1)
    console.log("pos2 "+posyear2)
    
    var div1 = document.getElementById('B3cursor1');
    var div2 = document.getElementById('B3cursor2');

    document.getElementById("B3thumbar").style.marginLeft=posyear1+"px"
    document.getElementById("B3thumbar").style.width=(posyear2-posyear1)+"px"
    triyear(i1,i2)
}

var minyear=0
var maxyear=0
var max=0
var min=0
        function checkyear(){
            console.log("minyear = "+minyear)
    var div1 = document.getElementById('B3cursor1');
    var div2 = document.getElementById('B3cursor2');

    var rect1 = div1.getBoundingClientRect();
    var rect2 = div2.getBoundingClientRect();

    var distanceX = rect2.left - rect1.left;
    var distanceY = rect2.top - rect1.top;

    var distance = Math.sqrt(Math.pow(distanceX, 2) + Math.pow(distanceY, 2));
    console.log(distance)
    
    let div1val=parseInt(div1.style.marginLeft, 10)
    let div2val=parseInt(div2.style.marginLeft, 10)

    let diff=(maxyear-minyear)/200



    min=Number(minyear)+Number(Math.round(div1val*diff))
    console.log("diff = "+div1val*diff)
    console.log(((div2val/200)+1))

    max=Math.round(maxyear-((200-div2val)*diff))
    console.log(minyear)
    
    console.log("maxyear = "+maxyear+" / minyear = "+minyear)
    document.getElementById("minyear1").value=Math.round(min)
    document.getElementById("maxyear1").value=Math.round(max)
    

    triyear(min,max)
}


function minmaxyear(){
    minyear=allcar[0].buildYear
    maxyear=allcar[0].buildYear
    for(i=0;i<allcar.length;i++){
        if(allcar[i].buildYear>maxyear){
            console.log(allcar[i].buildYear)
            maxyear=allcar[i].buildYear
        }else if(allcar[i].buildYear<minyear){
            console.log(allcar[i].buildYear)
            minyear=allcar[i].buildYear
        }
            
    }
    console.log("maxyear = "+maxyear+" / minyear = "+minyear)
    checkyear()
}