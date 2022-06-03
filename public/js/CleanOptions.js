

function CleanOptions()
{

      let options = $('.option')
      options.map(function(key){
            options[key].value = ''
      })
}