// Quantity buttons functionality
document.addEventListener("DOMContentLoaded", () => {
    // Check if we're on a product detail page with quantity buttons
    const decreaseBtn = document.getElementById("decrease-qty")
    const increaseBtn = document.getElementById("increase-qty")
    const quantityInput = document.getElementById("quantity")

    if (decreaseBtn && increaseBtn && quantityInput) {
      const maxStock = Number.parseInt(quantityInput.getAttribute("max") || "999")

      decreaseBtn.addEventListener("click", () => {
        const currentValue = Number.parseInt(quantityInput.value)
        if (currentValue > 1) {
          quantityInput.value = currentValue - 1
        }
      })

      increaseBtn.addEventListener("click", () => {
        const currentValue = Number.parseInt(quantityInput.value)
        if (currentValue < maxStock) {
          quantityInput.value = currentValue + 1
        }
      })
    }

    // Payment method toggle
    const paymentTransfer = document.getElementById("payment_transfer")
    const paymentCod = document.getElementById("payment_cod")
    const bankTransferDetails = document.getElementById("bank_transfer_details")
    const codDetails = document.getElementById("cod_details")

    if (paymentTransfer && paymentCod && bankTransferDetails && codDetails) {
      paymentTransfer.addEventListener("change", function () {
        if (this.checked) {
          bankTransferDetails.style.display = "block"
          codDetails.style.display = "none"
        }
      })

      paymentCod.addEventListener("change", function () {
        if (this.checked) {
          bankTransferDetails.style.display = "none"
          codDetails.style.display = "block"
        }
      })
    }

    // Form submission for COD orders
    const orderForm = document.getElementById("order-form")
    if (orderForm && paymentCod) {
      orderForm.addEventListener("submit", (e) => {
        if (paymentCod.checked) {
          e.preventDefault()
          // Get form data
          const formData = new FormData(orderForm)
          const userName = formData.get("user_name")
          const productName = document.querySelector(".text-2xl.font-bold.text-gray-900").textContent
          const quantity = formData.get("quantity")
          const address = formData.get("address")

          // Create WhatsApp message
          const message = `Hello, I would like to place a COD order:\n\nName: ${userName}\nProduct: ${productName}\nQuantity: ${quantity}\nAddress: ${address}\n\nPlease confirm my order. Thank you!`
          const encodedMessage = encodeURIComponent(message)

          // Open WhatsApp with pre-filled message
          window.open(`https://wa.me/6281234567890?text=${encodedMessage}`, "_blank")
        }
      })
    }

    // Image preview for file inputs
    const imageInput = document.getElementById("image")
    const imagePreview = document.getElementById("imagePreview")
    const inputWrapper = document.getElementById("imageInputWrapper")

    if (imageInput && imagePreview) {
      imageInput.addEventListener("change", (e) => {
        const [file] = e.target.files
        if (file) {
          imagePreview.src = URL.createObjectURL(file)
          imagePreview.classList.remove("hidden")

          if (inputWrapper) {
            inputWrapper.classList.add("hidden")
          }
        }
      })
    }
  })

  // Welcome page theme toggle functionality
  function initWelcomePage() {
    const themeToggle = document.getElementById("themeToggle")
    if (!themeToggle) return

    const moon = document.querySelector(".moon")
    const sun = document.querySelector(".sun")

    // Check for saved theme preference or use user's system preference
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches

    if (localStorage.getItem("theme") === "dark" || (!localStorage.getItem("theme") && prefersDark)) {
      document.body.classList.add("dark")
      moon.style.display = "none"
      sun.style.display = "block"
    }

    themeToggle.addEventListener("click", () => {
      document.body.classList.toggle("dark")

      if (document.body.classList.contains("dark")) {
        localStorage.setItem("theme", "dark")
        moon.style.display = "none"
        sun.style.display = "block"
      } else {
        localStorage.setItem("theme", "light")
        moon.style.display = "block"
        sun.style.display = "none"
      }
    })

    // Mobile menu functionality
    const mobileMenuBtn = document.querySelector(".mobile-menu-btn")
    const navLinks = document.querySelector(".nav-links")

    if (mobileMenuBtn && navLinks) {
      mobileMenuBtn.addEventListener("click", () => {
        navLinks.classList.toggle("active")
      })
    }

    // Set current year in footer
    const currentYearElement = document.getElementById("currentYear")
    if (currentYearElement) {
      currentYearElement.textContent = new Date().getFullYear()
    }
  }

  // Initialize welcome page if needed
  document.addEventListener("DOMContentLoaded", () => {
    if (document.body.classList.contains("welcome-page")) {
      initWelcomePage()
    }
  })

  // Quick date selector functionality for dashboard
  function setQuickDate(period) {
    if (!period) return

    const today = new Date()
    let startDate = new Date()
    let endDate = new Date()

    switch (period) {
      case "today":
        // Keep start and end as today
        break
      case "yesterday":
        startDate.setDate(today.getDate() - 1)
        endDate.setDate(today.getDate() - 1)
        break
      case "this_week":
        startDate.setDate(today.getDate() - today.getDay())
        break
      case "last_week":
        startDate.setDate(today.getDate() - today.getDay() - 7)
        endDate.setDate(today.getDate() - today.getDay() - 1)
        break
      case "this_month":
        startDate.setDate(1)
        break
      case "last_month":
        startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1)
        endDate = new Date(today.getFullYear(), today.getMonth(), 0)
        break
      case "this_year":
        startDate = new Date(today.getFullYear(), 0, 1)
        break
    }

    // Format dates for input fields
    const startDateInput = document.getElementById("start_date")
    const endDateInput = document.getElementById("end_date")

    if (startDateInput && endDateInput) {
      startDateInput.value = formatDate(startDate)
      endDateInput.value = formatDate(endDate)

      // Submit form
      const form = document.querySelector("form")
      if (form) form.submit()
    }
  }

  function formatDate(date) {
    const year = date.getFullYear()
    const month = String(date.getMonth() + 1).padStart(2, "0")
    const day = String(date.getDate()).padStart(2, "0")
    return `${year}-${month}-${day}`
  }
