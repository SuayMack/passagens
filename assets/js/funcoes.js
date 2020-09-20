/*
function execBtn(value){
    switch (value) {
      case 'ativo':

      break;
    case 'cancelado':

      break;
    }
  }
    */
  
  function addEventListenerAll(element, events, fn){
    events.split(' ').forEach(event => {
      element.addEventListener(event, fn, false)
  
    })
  }    

  
function myFunction() { 

  let span_status = document.querySelectorAll("#row_status > span")
  console.log(span_status)

  span_status.addEventListener('click', e=>{
    console.log(e)
  })




/*
  span_status.forEach()

  

    let status = document.querySelectorAll("#row_status").value
    console.log(status)
     
   
    //var textbtn = (status.outerText)
    //console.log(textbtn)
    /*
    status.forEach((elem, index)=>{
          var textbtn = (elem.innerHTML)
          console.log(textbtn)
    
          
    })
    
    
    
    
    
    /*
    status.forEach((elem, index)=>{
      this.addEventListenerAll( elem, "click drag", e => {
        var textbtn = (elem.innerHTML)
        console.log(textbtn)
  
        textbtn.forEach((stat, index)=>{
            if (stat = 'ativo'){
                console.log('está ativo')
            }else{
                console.log('está inativo')
            }
        })
  
      })
    })

    status.forEach(stts=>{

        stts.addEventListener('click', e => {
            console.log(e)
        })
        
    })
  
        /*
        if (this.textbtn == 'ativo'){
          document.getElementById("status").innerHTML = ("cancelado")
        }else{
          document.getElementById("status").innerHTML = ("ativo")
        }
        
  
      })
    */
}
  