

function RemoveOptions()
{

      let options = $('.options').children()
      options.map(function(key){
            if(key >= 3)
                  options[key].remove()
      })
}
