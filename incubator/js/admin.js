function submitButtonEnable(inputs, submitButton)
{
    const button = document.getElementById(submitButton)

    let enable = true

    for (let i = 0; i < inputs.length; i++)
    {
        if (document.getElementById(inputs[i]).value == '')
        {
            enable = false
            break
        }
    }

    if (enable)
    {
        if (button.hasAttribute('disabled')) button.removeAttribute('disabled')
    }
    else if (!button.hasAttribute('disabled')) button.setAttribute('disabled', 'true')
}
