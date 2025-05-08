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

    // Update the payment method toggle section to hide both courier selection and shipping options when COD is selected
    const paymentTransfer = document.getElementById("payment_transfer")
    const paymentCod = document.getElementById("payment_cod")
    const bankTransferDetails = document.getElementById("bank_transfer_details")
    const codDetails = document.getElementById("cod_details")
    const shippingServicesContainer = document.getElementById("shipping-services-container")
    const courierSelectionContainer = document.querySelector(
      ".mb-6.bg-white.p-4.rounded-lg.border.shadow-sm:has(.courier-option)",
    ) // Container for courier selection
    const shippingInformationContainer = document.querySelector(
        ".mb-6.bg-white.p-4.rounded-lg.border.shadow-sm:has([for='province_id'])"
    )
    const orderButton = document.getElementById("order-button")

    if (paymentTransfer && paymentCod && bankTransferDetails && codDetails) {
      paymentTransfer.addEventListener("change", function () {
        if (this.checked) {
          bankTransferDetails.style.display = "block"
          codDetails.style.display = "none"

          // Show shipping information for bank transfer
          if (shippingInformationContainer) {
            shippingInformationContainer.style.display = "block"
          }

          // Show courier selection for bank transfer
          if (courierSelectionContainer) {
            courierSelectionContainer.style.display = "block"
          }

          // Show shipping options for bank transfer if city and courier are selected
          if (shippingServicesContainer) {
            const cityId = document.getElementById("city_id")?.value
            const courier = document.querySelector('input[name="courier"]:checked')?.value

            if (cityId && courier) {
              shippingServicesContainer.style.display = "block"
            }
          }

          // Enable order button if shipping is selected
          if (orderButton) {
            const shippingCost = document.getElementById("shipping_cost")?.value
            if (shippingCost && Number(shippingCost) > 0) {
              orderButton.disabled = false
            } else {
              orderButton.disabled = true
            }
          }
        }
      })

      paymentCod.addEventListener("change", function () {
        if (this.checked) {
          bankTransferDetails.style.display = "none"
          codDetails.style.display = "block"

          // Hide shipping information for COD
          if (shippingInformationContainer) {
            shippingInformationContainer.style.display = "none"
          }

          // Hide courier selection for COD
          if (courierSelectionContainer) {
            courierSelectionContainer.style.display = "none"
          }

          // Hide shipping options for COD
          if (shippingServicesContainer) {
            shippingServicesContainer.style.display = "none"
          }

          // Always enable order button for COD
          if (orderButton) {
            orderButton.disabled = false
          }

          // Set default shipping cost to 0 for COD
          if (document.getElementById("shipping_cost")) {
            document.getElementById("shipping_cost").value = 0
          }

          // Set default courier and service to empty for COD
          if (document.getElementById("courier_service")) {
            document.getElementById("courier_service").value = ""
          }

          // Update summary
          if (typeof updateSummary === "function") {
            updateSummary()
          }
        }
      })

      // Check initial state on page load
      if (paymentCod.checked) {
        bankTransferDetails.style.display = "none"
        codDetails.style.display = "block"

        if (shippingInformationContainer) {
            shippingInformationContainer.style.display = "none"
        }

        // Hide courier selection and shipping options for COD
        if (courierSelectionContainer) {
          courierSelectionContainer.style.display = "none"
        }
        if (shippingServicesContainer) {
          shippingServicesContainer.style.display = "none"
        }

        // Enable order button
        if (orderButton) {
          orderButton.disabled = false
        }
      }
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
          const productName =
            document.querySelector(
              ".text-2xl.md\\:text-3xl.font-bold.text-text, .text-2xl.font-bold, h1.text-2xl.md\\:text-3xl.font-bold",
            )?.textContent || "Product"
          const quantity = formData.get("quantity")
          const price = document.querySelector(".text-3xl.font-bold.text-primary")?.textContent || "Price not available"
          const province =
            document.getElementById("province_id")?.options[document.getElementById("province_id").selectedIndex]?.text ||
            ""
          const city =
            document.getElementById("city_id")?.options[document.getElementById("city_id").selectedIndex]?.text || ""
          const address = formData.get("address")

          // Validate required fields
          if (!userName || !address || !province || !city) {
            alert("Please fill in all required fields: Name, Province, City, and Address")
            return
          }

          // Create WhatsApp message
          const message = `Hello, I would like to place a COD order:\n\n*Order Details*\nName: ${userName}\nProduct: ${productName}\nQuantity: ${quantity}\nPrice: ${price}\n\n*Shipping Address*\n${address}\n${city}, ${province}\n\nPlease confirm my order. Thank you!`
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

    // Welcome page theme toggle functionality
    initWelcomePage()

    // Header scroll effect
    const header = document.getElementById("header")
    if (header) {
      window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
          header.classList.add("scrolled")
        } else {
          header.classList.remove("scrolled")
        }
      })
    }

    // Mobile menu functionality
    const mobileMenuBtn = document.getElementById("mobileMenuBtn")
    const mobileNav = document.getElementById("mobileNav")
    const closeMenu = document.getElementById("closeMenu")

    if (mobileMenuBtn && mobileNav && closeMenu) {
      mobileMenuBtn.addEventListener("click", () => {
        mobileNav.classList.add("active")
        document.body.style.overflow = "hidden"
      })

      closeMenu.addEventListener("click", () => {
        mobileNav.classList.remove("active")
        document.body.style.overflow = "auto"
      })
    }

    // Product detail page functionality
    initProductDetailPage()

    // Set up scroll animation
    window.addEventListener("scroll", animateOnScroll)
    animateOnScroll() // Run once on load
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

  // Update the initProductDetailPage function to include the additional functionality
  function initProductDetailPage() {
    // Get elements
    const provinceSelect = document.getElementById("province_id")
    const citySelect = document.getElementById("city_id")
    const courierRadios = document.querySelectorAll(".courier-radio")
    const shippingServicesContainer = document.getElementById("shipping-services-container")
    const shippingServices = document.getElementById("shipping-services")
    const shippingServicesLoading = document.getElementById("shipping-services-loading")
    const quantityInput = document.getElementById("quantity")
    const orderButton = document.getElementById("order-button")
    const addressTextarea = document.getElementById("address")
    const summaryAddress = document.getElementById("summary-address")

    if (!provinceSelect || !citySelect) return

    // Format currency function
    function formatCurrency(amount) {
      return "Rp " + new Intl.NumberFormat("id-ID").format(amount)
    }

    // Update summary
    function updateSummary() {
      const summaryQuantity = document.getElementById("summary-quantity")
      const summarySubtotal = document.getElementById("summary-subtotal")
      const summaryShipping = document.getElementById("summary-shipping")
      const summaryTotal = document.getElementById("summary-total")

      if (!summaryQuantity || !summarySubtotal || !summaryShipping || !summaryTotal) return

      const quantity = Number.parseInt(quantityInput.value)
      // Fix the price selector to match the new layout
      const productPrice =
        document.querySelector(".text-3xl.font-bold.text-primary")?.textContent.replace(/[^\d]/g, "") || 0
      const shippingCost = Number.parseInt(document.getElementById("shipping_cost").value) || 0
      const subtotal = quantity * productPrice
      const total = subtotal + shippingCost

      summaryQuantity.textContent = quantity
      summarySubtotal.textContent = formatCurrency(subtotal)
      summaryShipping.textContent = formatCurrency(shippingCost)
      summaryTotal.textContent = formatCurrency(total)
    }

    // Update address summary when address fields change
    function updateAddressSummary() {
      if (!provinceSelect || !citySelect || !addressTextarea || !summaryAddress) return

      const province = provinceSelect.options[provinceSelect.selectedIndex]?.text || ""
      const city = citySelect.options[citySelect.selectedIndex]?.text || ""
      const address = addressTextarea.value

      if (province && city && address) {
        summaryAddress.innerHTML = `${address}, ${city}, ${province}`
      } else {
        summaryAddress.innerHTML = '<p class="italic text-gray-400">Please fill in your shipping information</p>'
      }
    }

    // Province change handler
    if (provinceSelect) {
      provinceSelect.addEventListener("change", function () {
        const provinceId = this.value
        citySelect.disabled = true
        citySelect.innerHTML = '<option value="">Loading cities...</option>'

        if (provinceId) {
          fetch(`/api/cities?province_id=${provinceId}`)
            .then((response) => response.json())
            .then((cities) => {
              citySelect.innerHTML = '<option value="">Select City</option>'
              cities.forEach((city) => {
                const option = document.createElement("option")
                option.value = city.city_id
                option.textContent = `${city.type} ${city.city_name}`
                citySelect.appendChild(option)
              })
              citySelect.disabled = false
              updateAddressSummary()
            })
            .catch((error) => {
              console.error("Error fetching cities:", error)
              citySelect.innerHTML = '<option value="">Error loading cities</option>'
              citySelect.disabled = false
            })
        } else {
          citySelect.innerHTML = '<option value="">Select City</option>'
          citySelect.disabled = true
        }

        // Reset shipping options
        if (shippingServicesContainer) {
          shippingServicesContainer.style.display = "none"
        }
        if (shippingServices) {
          shippingServices.innerHTML = ""
        }
        if (document.getElementById("shipping_cost")) {
          document.getElementById("shipping_cost").value = 0
        }
        if (document.getElementById("courier_service")) {
          document.getElementById("courier_service").value = ""
        }
        updateSummary()
        updateAddressSummary()
        if (orderButton) {
          orderButton.disabled = true
        }
      })
    }

    // City change handler
    if (citySelect) {
      citySelect.addEventListener("change", () => {
        calculateShipping()
        updateAddressSummary()
      })
    }

    // Address change handler
    if (addressTextarea) {
      addressTextarea.addEventListener("input", updateAddressSummary)
    }

    // Courier change handler
    if (courierRadios) {
      courierRadios.forEach((radio) => {
        radio.addEventListener("change", () => {
          calculateShipping()
        })
      })
    }

    // Calculate shipping cost
    function calculateShipping() {
      if (!citySelect || !shippingServicesContainer || !shippingServices || !shippingServicesLoading) return

      const cityId = citySelect.value
      const courier = document.querySelector('input[name="courier"]:checked')?.value
      const quantity = Number.parseInt(quantityInput?.value || 1)
      const originCity = document.querySelector('meta[name="origin-city"]')?.getAttribute("content")

      // Reset shipping services
      shippingServices.innerHTML = ""

      if (!cityId || !courier) {
        shippingServicesContainer.style.display = "none"
        if (document.getElementById("shipping_cost")) {
          document.getElementById("shipping_cost").value = 0
        }
        if (document.getElementById("courier_service")) {
          document.getElementById("courier_service").value = ""
        }
        updateSummary()
        if (orderButton) {
          orderButton.disabled = true
        }
        return
      }

      // Assume each book weighs 500 grams
      const weight = quantity * 500

      // Show loading state
      shippingServicesContainer.style.display = "block"
      shippingServicesLoading.style.display = "block"
      shippingServices.style.display = "none"

      fetch("/api/shipping/cost", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
          origin: originCity || "501", // Default to Jakarta if not specified
          destination: cityId,
          weight: weight,
          courier: courier,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok")
          }
          return response.json()
        })
        .then((data) => {
          // Hide loading state
          shippingServicesLoading.style.display = "none"
          shippingServices.style.display = "block"

          if (data.length > 0 && data[0].costs && data[0].costs.length > 0) {
            data[0].costs.forEach((service, index) => {
              const serviceHtml = `
                <label class="flex items-center p-3 border rounded-md shipping-service-label hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                  <input type="radio" name="shipping_service_option" value="${service.service}"
                    data-cost="${service.cost[0].value}"
                    data-service="${service.service}"
                    ${index === 0 ? "checked" : ""}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 shipping-service-radio">
                  <div class="ml-3 flex-1">
                    <div class="flex justify-between">
                      <div>
                        <span class="font-medium text-gray-900">${service.service}</span>
                        <p class="text-sm text-gray-500">${service.description}</p>
                        <p class="text-xs text-gray-500">Estimated: ${service.cost[0].etd} day(s)</p>
                      </div>
                      <span class="text-blue-600 font-medium">Rp ${new Intl.NumberFormat("id-ID").format(service.cost[0].value)}</span>
                    </div>
                  </div>
                </label>
              `
              shippingServices.insertAdjacentHTML("beforeend", serviceHtml)
            })

            // Select first shipping option by default
            const firstShippingOption = document.querySelector(".shipping-service-radio")
            if (firstShippingOption) {
              firstShippingOption.checked = true
              if (document.getElementById("shipping_cost")) {
                document.getElementById("shipping_cost").value = firstShippingOption.dataset.cost
              }
              if (document.getElementById("courier_service")) {
                document.getElementById("courier_service").value = firstShippingOption.dataset.service
              }
              updateSummary()
            }

            // Add event listeners to shipping service radios
            document.querySelectorAll(".shipping-service-radio").forEach((radio) => {
              radio.addEventListener("change", function () {
                if (document.getElementById("shipping_cost")) {
                  document.getElementById("shipping_cost").value = this.dataset.cost
                }
                if (document.getElementById("courier_service")) {
                  document.getElementById("courier_service").value = this.dataset.service
                }
                updateSummary()
              })
            })

            if (orderButton) {
              orderButton.disabled = false
            }
          } else {
            shippingServices.innerHTML =
              '<div class="p-3 text-center text-red-500">No shipping services available for this destination</div>'
            if (document.getElementById("shipping_cost")) {
              document.getElementById("shipping_cost").value = 0
            }
            if (document.getElementById("courier_service")) {
              document.getElementById("courier_service").value = ""
            }
            updateSummary()
            if (orderButton) {
              orderButton.disabled = true
            }
          }
        })
        .catch((error) => {
          console.error("Error calculating shipping:", error)
          shippingServicesLoading.style.display = "none"
          shippingServices.style.display = "block"
          shippingServices.innerHTML = '<div class="p-3 text-center text-red-500">Error calculating shipping cost</div>'
          if (document.getElementById("shipping_cost")) {
            document.getElementById("shipping_cost").value = 0
          }
          if (document.getElementById("courier_service")) {
            document.getElementById("courier_service").value = ""
          }
          updateSummary()
          if (orderButton) {
            orderButton.disabled = true
          }
        })
    }

    // Image zoom functionality
    initProductImageZoom()

    // Enhance form interactions
    enhanceFormInteractions()

    // Enhance radio selections
    enhanceRadioSelections()

    // Initialize address summary
    updateAddressSummary()
  }

  // Image zoom functionality
  function initProductImageZoom() {
    const zoomContainer = document.querySelector(".zoom-container")
    const productImage = document.querySelector(".product-main-image")
    const zoomLens = document.getElementById("zoom-lens")
    const zoomResult = document.getElementById("zoom-result")

    if (zoomContainer && productImage && zoomLens && zoomResult) {
      let active = false
      const lensSize = 100

      // Set up zoom lens
      zoomLens.style.width = lensSize + "px"
      zoomLens.style.height = lensSize + "px"

      zoomContainer.addEventListener("mouseenter", (event) => {
        if (window.innerWidth >= 768) {
          // Only on desktop
          active = true
          zoomLens.classList.remove("hidden")
          zoomResult.classList.remove("hidden")
          updateZoomImage(event)
        }
      })

      zoomContainer.addEventListener("mouseleave", () => {
        active = false
        zoomLens.classList.add("hidden")
        zoomResult.classList.add("hidden")
      })

      zoomContainer.addEventListener("mousemove", (e) => {
        if (active) {
          updateZoomImage(e)
        }
      })

      function updateZoomImage(e) {
        // Get relative position
        const rect = zoomContainer.getBoundingClientRect()
        const x = e.clientX - rect.left
        const y = e.clientY - rect.top

        // Calculate lens position
        let lensX = x - lensSize / 2
        let lensY = y - lensSize / 2

        // Constrain lens to image
        lensX = Math.max(0, Math.min(lensX, rect.width - lensSize))
        lensY = Math.max(0, Math.min(lensY, rect.height - lensSize))

        // Position lens
        zoomLens.style.left = lensX + "px"
        zoomLens.style.top = lensY + "px"

        // Calculate zoom ratio
        const ratioX = zoomResult.offsetWidth / lensSize
        const ratioY = zoomResult.offsetHeight / lensSize

        // Set background of result
        zoomResult.style.backgroundImage = `url(${productImage.src})`
        zoomResult.style.backgroundSize = `${rect.width * ratioX}px ${rect.height * ratioY}px`
        zoomResult.style.backgroundPosition = `-${lensX * ratioX}px -${lensY * ratioY}px`
      }
    }
  }

  // Animate elements on scroll
  function animateOnScroll() {
    const elements = document.querySelectorAll(".animate-on-scroll")

    elements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top
      const elementVisible = 150

      if (elementTop < window.innerHeight - elementVisible) {
        element.classList.add("visible")
      }
    })
  }

  // Enhance form interactions
  function enhanceFormInteractions() {
    const formInputs = document.querySelectorAll("input, select, textarea")
    formInputs.forEach((input) => {
      input.addEventListener("focus", function () {
        this.closest(".mb-4, .mb-6")?.classList.add("highlight-field")
      })

      input.addEventListener("blur", function () {
        this.closest(".mb-4, .mb-6")?.classList.remove("highlight-field")
      })
    })
  }

  // Enhance radio selections
  function enhanceRadioSelections() {
    const radioLabels = document.querySelectorAll(".courier-option, .payment-method-label, .shipping-service-label")
    radioLabels.forEach((label) => {
      const radio = label.querySelector('input[type="radio"]')

      if (radio) {
        // Set initial state
        if (radio.checked) {
          label.classList.add("selected-option")
        }

        // Update on change
        radio.addEventListener("change", function () {
          // Remove selected class from all options in the same group
          document.querySelectorAll(`input[name="${this.name}"]`).forEach((r) => {
            r.closest(".courier-option, .payment-method-label, .shipping-service-label")?.classList.remove(
              "selected-option",
            )
          })

          // Add selected class to this option
          if (this.checked) {
            label.classList.add("selected-option")
          }
        })
      }
    })
  }

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
