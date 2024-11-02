// Get the modal
var modal = document.getElementById("imageModal");

// Get the image and insert it inside the modal
var modalImg = document.getElementById("modalImg");
var images = document.querySelectorAll(".product-img");

// Loop through all images and add click event
images.forEach(function(img) {
    img.onclick = function(){
        modal.style.display = "flex";  // Show the modal
        modalImg.src = this.src;  // Set the modal image source to the clicked image
    }
});

// Get the close button and add event to close the modal
var closeModal = document.getElementById("closeModal");
closeModal.onclick = function() {
    modal.style.display = "none";  // Hide the modal
}

