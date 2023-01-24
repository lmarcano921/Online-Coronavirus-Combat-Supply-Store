const codecheck = document.getElementById('codecheck')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => 
{ 
    
    let messages = []
    if (codecheck.value === '' || codecheck.value === null )
    {
        messages.push('A code is required')
    } 
    /*if (codecheck.value === code.value) //testcase to see if passwords match, no longer needed since this is the desired outcome
    {
        messages.push('Success!')
    }*/
    if (codecheck.value != code)
    {
        messages.push('Input does not match code sent ')
    }
    if (messages.length > 0)
    {
        e.preventDefault()
        errorElement.innerText = messages.join('\n')
    }
})

