document.addEventListener("DOMContentLoaded", () => {
    // Mock data for productData and shippingMethods
    const productData = {
      price: 100000, // Example price
    }

    const shippingMethods = [
      { id: 1, name: "Standard Shipping", price: 15000 },
      { id: 2, name: "Express Shipping", price: 30000 },
    ]

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById("mobile-menu-button")
    const closeMobileMenu = document.getElementById("close-mobile-menu")
    const mobileMenu = document.getElementById("mobile-menu")
    const mobileMenuOverlay = document.getElementById("mobile-menu-overlay")

    if (mobileMenuButton && closeMobileMenu && mobileMenu && mobileMenuOverlay) {
      mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.add("open")
        mobileMenuOverlay.classList.remove("hidden")
        document.body.style.overflow = "hidden"
      })

      closeMobileMenu.addEventListener("click", () => {
        mobileMenu.classList.remove("open")
        mobileMenuOverlay.classList.add("hidden")
        document.body.style.overflow = ""
      })

      mobileMenuOverlay.addEventListener("click", () => {
        mobileMenu.classList.remove("open")
        mobileMenuOverlay.classList.add("hidden")
        document.body.style.overflow = ""
      })
    }

    // Product tabs
    const tabButtons = document.querySelectorAll(".product-tab-btn")
    const tabContents = document.querySelectorAll(".product-tab-content")

    tabButtons.forEach((button) => {
      button.addEventListener("click", () => {
        // Remove active class from all buttons
        tabButtons.forEach((btn) => {
          btn.classList.remove("active-tab", "text-blue-600", "border-b-2", "border-blue-600")
          btn.classList.add("text-gray-500", "hover:text-gray-700")
        })

        // Add active class to clicked button
        button.classList.add("active-tab", "text-blue-600", "border-b-2", "border-blue-600")
        button.classList.remove("text-gray-500", "hover:text-gray-700")

        // Hide all tab contents
        tabContents.forEach((content) => {
          content.classList.add("hidden")
        })

        // Show the corresponding tab content
        const tabId = button.getAttribute("data-tab")
        const activeTab = document.getElementById(`${tabId}-tab`)
        if (activeTab) {
          activeTab.classList.remove("hidden")
        }
      })
    })

    // FAQ accordion
    const faqQuestions = document.querySelectorAll(".faq-question")
    faqQuestions.forEach((question) => {
      question.addEventListener("click", () => {
        const answer = question.nextElementSibling
        const icon = question.querySelector(".fa-chevron-down")

        // Toggle the answer visibility
        answer.classList.toggle("hidden")

        // Toggle the icon rotation
        if (icon) {
          icon.classList.toggle("transform")
          icon.classList.toggle("rotate-180")
        }

        // Update aria-expanded
        const isExpanded = answer.classList.contains("hidden") ? "false" : "true"
        question.setAttribute("aria-expanded", isExpanded)
      })
    })

    // Quantity selector
    const decreaseBtn = document.getElementById("decrease-qty")
    const increaseBtn = document.getElementById("increase-qty")
    const quantityInput = document.getElementById("quantity")
    const formQuantityInput = document.getElementById("form-quantity")
    const summaryQuantity = document.getElementById("summary-quantity")
    const summaryQuantityBadge = document.getElementById("summary-quantity-badge")

    if (decreaseBtn && increaseBtn && quantityInput) {
      decreaseBtn.addEventListener("click", () => {
        let value = Number.parseInt(quantityInput.value)
        if (value > 1) {
          value--
          quantityInput.value = value
          if (formQuantityInput) formQuantityInput.value = value
          if (summaryQuantity) summaryQuantity.textContent = value
          if (summaryQuantityBadge) summaryQuantityBadge.textContent = value
          updateSummary()
        }
      })

      increaseBtn.addEventListener("click", () => {
        let value = Number.parseInt(quantityInput.value)
        const max = Number.parseInt(quantityInput.getAttribute("max") || 999)
        if (value < max) {
          value++
          quantityInput.value = value
          if (formQuantityInput) formQuantityInput.value = value
          if (summaryQuantity) summaryQuantity.textContent = value
          if (summaryQuantityBadge) summaryQuantityBadge.textContent = value
          updateSummary()
        }
      })

      quantityInput.addEventListener("change", () => {
        let value = Number.parseInt(quantityInput.value)
        const max = Number.parseInt(quantityInput.getAttribute("max") || 999)

        if (isNaN(value) || value < 1) {
          value = 1
        } else if (value > max) {
          value = max
        }

        quantityInput.value = value
        if (formQuantityInput) formQuantityInput.value = value
        if (summaryQuantity) summaryQuantity.textContent = value
        if (summaryQuantityBadge) summaryQuantityBadge.textContent = value
        updateSummary()
      })
    }

    // Update order summary
    function updateSummary() {
      const productPrice = productData.price
      const quantity = Number.parseInt(document.getElementById("quantity").value)
      const subtotal = productPrice * quantity

      const subtotalEl = document.getElementById("summary-subtotal")
      const taxEl = document.getElementById("summary-tax")

      if (subtotalEl) {
        subtotalEl.textContent = "Rp " + subtotal.toLocaleString("id-ID")
      }

      if (taxEl) {
        const tax = subtotal * 0.1
        taxEl.textContent = "Rp " + tax.toLocaleString("id-ID")
      }

      updateTotal()
    }

    // Update total when shipping method changes
    const shippingRadios = document.querySelectorAll(".shipping-method-radio")
    const shippingLabels = document.querySelectorAll(".shipping-method-label")

    shippingRadios.forEach((radio, index) => {
      radio.addEventListener("change", () => {
        // Update styles for all labels
        shippingLabels.forEach((label) => {
          label.classList.remove("border-blue-500", "bg-blue-50")
          label.classList.add("border-gray-300")
        })

        // Update style for selected label
        shippingLabels[index].classList.remove("border-gray-300")
        shippingLabels[index].classList.add("border-blue-500", "bg-blue-50")

        // Update shipping cost and total
        updateShippingCost()
      })
    })

    function updateShippingCost() {
      const selectedShipping = document.querySelector('input[name="shipping_method_id"]:checked')
      const shippingPriceEl = document.getElementById("summary-shipping")

      if (selectedShipping && shippingPriceEl) {
        const shippingId = Number.parseInt(selectedShipping.value)
        const shippingMethod = shippingMethods.find((method) => method.id === shippingId)

        if (shippingMethod) {
          shippingPriceEl.textContent = "Rp " + shippingMethod.price.toLocaleString("id-ID")
        }
      }

      updateTotal()
    }

    function updateTotal() {
      const productPrice = productData.price
      const quantity = Number.parseInt(document.getElementById("quantity").value)
      const subtotal = productPrice * quantity
      const tax = subtotal * 0.1

      // Get shipping cost
      let shippingCost = 0
      const selectedShipping = document.querySelector('input[name="shipping_method_id"]:checked')

      if (selectedShipping) {
        const shippingId = Number.parseInt(selectedShipping.value)
        const shippingMethod = shippingMethods.find((method) => method.id === shippingId)

        if (shippingMethod) {
          shippingCost = Number.parseFloat(shippingMethod.price)
        }
      }

      // Calculate total as numbers to avoid string concatenation issues
      const total = subtotal + tax + shippingCost
      const totalEl = document.getElementById("summary-total")

      if (totalEl) {
        totalEl.textContent = "Rp " + total.toLocaleString("id-ID")
      }

      // Also update shipping display to ensure consistent formatting
      const shippingPriceEl = document.getElementById("summary-shipping")
      if (shippingPriceEl && shippingCost > 0) {
        shippingPriceEl.textContent = "Rp " + shippingCost.toLocaleString("id-ID")
      }
    }

    // Initialize shipping information
    updateShippingCost()

    // Toggle checkout form
    const orderNowBtn = document.getElementById("order-now-btn")
    const checkoutForm = document.getElementById("checkout-form-container")
    const cancelCheckoutBtn = document.getElementById("cancel-checkout-btn")

    if (orderNowBtn && checkoutForm && cancelCheckoutBtn) {
      orderNowBtn.addEventListener("click", () => {
        checkoutForm.classList.remove("hidden")
        window.scrollTo({
          top: checkoutForm.offsetTop - 100,
          behavior: "smooth",
        })
      })

      cancelCheckoutBtn.addEventListener("click", () => {
        checkoutForm.classList.add("hidden")
      })
    }

    // Notify me modal
    const notifyMeBtn = document.getElementById("notify-me-btn")
    const notifyModal = document.getElementById("notify-modal")
    const closeNotifyModal = document.getElementById("close-notify-modal")
    const notifyForm = document.getElementById("notify-form")

    if (notifyMeBtn && notifyModal && closeNotifyModal && notifyForm) {
      notifyMeBtn.addEventListener("click", () => {
        notifyModal.classList.remove("hidden")
      })

      closeNotifyModal.addEventListener("click", () => {
        notifyModal.classList.add("hidden")
      })

      notifyForm.addEventListener("submit", (e) => {
        e.preventDefault()

        // Simulate form submission
        const submitBtn = notifyForm.querySelector('button[type="submit"]')
        const originalText = submitBtn.innerHTML

        submitBtn.innerHTML = '<i class="fas fa-spinner spinner mr-2"></i> Mengirim...'
        submitBtn.disabled = true

        setTimeout(() => {
          notifyModal.classList.add("hidden")

          Toastify({
            text: "Terima kasih! Kami akan memberi tahu Anda saat produk tersedia.",
            duration: 3000,
            gravity: "top",
            position: "center",
            backgroundColor: "#4CAF50",
            stopOnFocus: true,
          }).showToast()

          // Reset form
          notifyForm.reset()
          submitBtn.innerHTML = originalText
          submitBtn.disabled = false
        }, 1500)
      })
    }

    // Image gallery
    const galleryThumbs = document.querySelectorAll(".image-gallery-thumb")
    const mainImage = document.getElementById("main-product-image")

    if (galleryThumbs.length > 0 && mainImage) {
      galleryThumbs.forEach((thumb) => {
        thumb.addEventListener("click", () => {
          // Update active thumbnail
          galleryThumbs.forEach((t) => {
            t.classList.remove("active", "border-blue-400")
            t.classList.add("border-gray-200")
          })

          thumb.classList.add("active", "border-blue-400")
          thumb.classList.remove("border-gray-200")

          // Update main image
          const imgSrc = thumb.getAttribute("data-src")
          if (imgSrc) {
            mainImage.src = imgSrc
          }
        })
      })
    }

    // Back to top button
    const backToTopButton = document.getElementById("back-to-top")

    if (backToTopButton) {
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 300) {
          backToTopButton.classList.remove("opacity-0")
          backToTopButton.classList.add("opacity-100")
        } else {
          backToTopButton.classList.remove("opacity-100")
          backToTopButton.classList.add("opacity-0")
        }
      })

      backToTopButton.addEventListener("click", () => {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        })
      })
    }

    // Add to cart button (simulated)
    const addToCartBtn = document.getElementById("add-to-cart-btn")

    if (addToCartBtn) {
      addToCartBtn.addEventListener("click", () => {
        Toastify({
          text: "Produk telah ditambahkan ke wishlist!",
          duration: 3000,
          gravity: "top",
          position: "right",
          backgroundColor: "#3B82F6",
          stopOnFocus: true,
        }).showToast()
      })
    }

    // Quick view modal (simulated)
    const quickViewModal = document.getElementById("quick-view-modal")
    const closeQuickView = document.getElementById("close-quick-view")

    if (quickViewModal && closeQuickView) {
      closeQuickView.addEventListener("click", () => {
        quickViewModal.classList.add("hidden")
      })
    }

    // Image zoom effect
    const zoomContainer = document.querySelector(".zoom-container")
    const zoomImage = zoomContainer ? zoomContainer.querySelector("img") : null

    if (zoomContainer && zoomImage) {
      zoomContainer.addEventListener("mousemove", (e) => {
        const { left, top, width, height } = zoomContainer.getBoundingClientRect()
        const x = (e.clientX - left) / width
        const y = (e.clientY - top) / height

        zoomImage.style.transformOrigin = `${x * 100}% ${y * 100}%`
        zoomImage.style.transform = "scale(1.5)"
      })

      zoomContainer.addEventListener("mouseleave", () => {
        zoomImage.style.transform = "scale(1)"
      })
    }
  })
