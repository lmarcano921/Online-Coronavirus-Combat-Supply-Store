const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => 
{ 
    
    let messages = []
    if (code === 0)
    {
        messages.push('Invalid or empty code')
    } 
    if (code === 1) //testcase to see if passwords match, no longer needed since this is the desired outcome
    {
        messages.push('Success!')
    }
    if (messages.length > 0)
    {
        e.preventDefault()
        errorElement.innerText = messages.join('\n')
    }
})