
var alreadyVoted = false ;
function Vote()
{

      let vote_id = $('input[name=vote]:checked').val()
      if(started)
            if(!alreadyVoted)
                  axios.get(sendVoteRoute + `/${vote_id}`).then((response) => {

                        console.log(response.data)

                        let votes = $(`#votes_${vote_id}`)
                        votes.text(parseInt(votes.text()) +1)
                        alreadyVoted = true
                  }).catch(function (error) {
                        console.log(error);
                  })
            else
                  alert('Você já votou nesta Enquete')
      else
            alert('Essa Enquete não está em andamento')
}