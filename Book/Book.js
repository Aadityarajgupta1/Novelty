const optionMenu = document.querySelector(".select-menu"),
      selectBtn = optionMenu.querySelector(".select-btn"),
      options = optionMenu.querySelectorAll(".option"),
      sBtn_text = optionMenu.querySelector(".sBtn-text");


selectBtn.addEventListener("click", () => optionMenu.classList.toggle('active'));
$('#myReload').load(location.href + " #myReload");
options.forEach(option =>{
    option.addEventListener("click", ()=>{
        let selectedOption = option.querySelector(".option-text").innerText;
        sBtn_text.innerText = selectedOption;
        
        optionMenu.classList.remove('active');
        
    })
    
})

const optionMenu1 = document.querySelector(".select-menu1"),
      selectBtn1 = optionMenu1.querySelector(".select-btn1"),
      options1 = optionMenu1.querySelectorAll(".option1"),
      sBtn_text1 = optionMenu1.querySelector(".sBtn-text1");

selectBtn1.addEventListener("click", () => optionMenu1.classList.toggle('active'));

options1.forEach(option1 => {
    option1.addEventListener("click", () => {
        const selectedOption = option1.querySelector(".option-text").innerText;
        sBtn_text1.innerText = selectedOption;
        
        optionMenu1.classList.remove('active');
        
        // Submit the form automatically upon selecting an option
        option1.closest("form").submit();
    });
});


