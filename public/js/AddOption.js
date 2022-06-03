
optionsCount = $('.option').length

function AddOption()
{

      optionsCount ++
      let optionsList = $('.options')

      optionsList.append(`
            <li id="option-${optionsCount}">
                  <div class="row mb-4">

                        <div class="col-md-11">

                              <input type="text" name="option[${optionsCount}]" class="form-control option">
                        </div>
                        <div class="col-md-1">

                              <button type="button" data-bs-target="#option-${optionsCount}" class="btn-close mt-1"
                                    aria-label="close" id="hide-${optionsCount}" data-bs-dismiss="alert" tabindex="-1"
                              ></button>
                        </div>
                  </div>
            </li>
      `)
}