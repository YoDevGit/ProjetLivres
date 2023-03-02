const deleteConfirm = document.querySelectorAll("[data-name=deleteConfirm]");

deleteConfirm.forEach(function(lienDelete){
    lienDelete.addEventListener('click', function(event){
        event.preventDefault();
        if (confirm("sure?")){
            location.href = lienDelete.getAttribute("href");
        }
        console.log(lienDelete);
    })
//   return confirm("sure?");
    // alert('coucou');
})