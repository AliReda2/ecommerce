let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

$(document).ready(function() {
  $('.update-form input[name="quantity"]').on('input', function() {
      var form = $(this).closest('form');
      var formData = form.serialize();

      $.ajax({
          type: 'POST',
          url: 'updateQuantity.php',
          data: formData,
          success: function(data) {
              try {
                  var response = JSON.parse(data);
                  if (response.success) {
                      // Quantity updated successfully
                      var newTotalPrice = response.newTotalPrice;

                      // Update total price in the current row
                      var totalPriceCell = form.closest('tr').find('.total-price');
                      totalPriceCell.text('$' + newTotalPrice);

                      // Update grand total
                      var grandTotalElement = $('.bottom_btn span');
                      grandTotalElement.text('$' + response.newGrandTotal);
                  } else {
                      alert('Failed to update quantity');
                  }
              } catch (error) {
                  console.error('Error parsing JSON response:', error);
                  alert('An error occurred while updating the quantity');
              }
          },
          error: function() {
              console.error('Error occurred while updating the quantity');
              alert('An error occurred while updating the quantity');
          }
      });
  });
});
