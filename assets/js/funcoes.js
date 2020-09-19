function execBtn(value){
    switch (value) {
      
    }
  }
  
  
  
  
  
  
  function myFunction() { 
  
    let status = document.querySelectorAll("#status")
    status.forEach((elem, index)=>{
      this.addEventListenerAll( elem, "click drag", e => {
        var textbtn = (elem.innerHTML)
        this.execBtn(textbtn)
  
        /*
        if (this.textbtn == 'ativo'){
          document.getElementById("status").innerHTML = ("cancelado")
        }else{
          document.getElementById("status").innerHTML = ("ativo")
        }
        */
  
      })
    })
   
    
  }
  