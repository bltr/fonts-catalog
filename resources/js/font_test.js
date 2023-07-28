let text = document.querySelector('#text')
let font_color = document.querySelector('#font_color')
let background_color = document.querySelector('#background_color')
let example_text = document.querySelector('#example_text')

text.addEventListener('input', modifyText)
font_color.addEventListener('input', modifyFontColor)
background_color.addEventListener('input', modifyBackgroundColor)

function modifyText(e)
{
    example_text.innerHTML = e.currentTarget.value
}

function modifyFontColor(e)
{
    example_text.style.color = e.currentTarget.value
}

function modifyBackgroundColor(e)
{
    example_text.style.backgroundColor = e.currentTarget.value
}
