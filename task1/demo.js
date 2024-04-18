var button = document.getElementById("myButton");
button.addEventListener("click", function() {
    alert("Button was clicked.");

    let div1 = document.getElementById("div1");
    let div2 = document.getElementById("div2");

    if (div1 && div1.textContent) {
        const text = div1.textContent;
        
        let oddDelay = 0;

        text.split('').forEach((char, i) => {
            let delay;

            if (i % 2 === 1) {
                delay = 4 + i;
                oddDelay = delay;
            } else {
                delay = oddDelay + 1;
            }

            setTimeout(() => {
                div2.textContent += char;
            }, delay * 1000); 
        });
    } else {
        console.warn("div1 does not have text content.");
    }
});
