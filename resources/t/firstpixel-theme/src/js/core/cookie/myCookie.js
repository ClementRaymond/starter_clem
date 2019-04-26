var LetsAnimate = require("../animation/requestAnimation.js")

var myCookie = function() {
  this.value = Cookies.get("cookiebar")
  this.run()
}

myCookie.prototype = {
  /**
   * run function
   * @return {void}
   */
  run: function() {
    if (this.value !== undefined) return
    this.Animation = new LetsAnimate()
    this.render()
    this.letsAppend()
    this.accept.on("click", this.closeModale.bind(this))
  },

  /**
   * output the HTML
   * @return {object} jquery object
   */
  render: function() {
    this.container = $("<div/>", {
      id: "cookie",
      class: "cookie"
    })

    this.row = $("<div/>", {
      class: "row"
    })

    this.bg = $("<div/>", {
      class: "cookie-bg"
    })

    this.col1 = $("<div/>", {
      class: "small-12 columns",
      text: objectTrad.cookieText + " "
    })

    this.col2 = $("<div/>", {
      class: "small-12 columns"
    })

    this.link = $("<a/>", {
      href: objectTrad.cookieLink,
      text: objectTrad.cookieLearn
    })

    this.accept = $("<button/>", {
      class: "cookie_btn",
      id: "cookie_accept",
      text: objectTrad.cookieValide
    })

    return this.container
  },

  /**
   * append elem in dom
   * @return {mixed}
   */
  letsAppend: function() {
    this.link.appendTo(this.col1)
    this.accept.appendTo(this.col2)
    this.col1.appendTo(this.row)
    this.col2.appendTo(this.row)
    this.row.appendTo(this.container)
    this.container.css({ transform: "translateY(100%)" })
    return $("body").prepend(this.container), this.openModale()
  },
  /**
   * openModale
   * @return {mixed}
   */
  openModale: function() {
    var self = this
    return setTimeout(function() {
      self.Animation.request(
        function() {
          self.container.css({
            transform:
              "translateY(" + self.Animation.interpolation(100, 0) + "%)"
          })
        },
        function() {
          self.container.css({ transform: "translateY(0)" })
          $("body").prepend(self.bg)
        }
      )
    }, 2000)
  },

  /**
   * close the cookie bar
   * @param  {object} e event
   * @return {boolean}  return true if closed
   */
  closeModale: function(e) {
    e.preventDefault()
    Cookies.set("cookiebar", "viewed", { expires: 30 })
    var self = this
    self.Animation.request(
      function() {
        self.container.css({
          transform: "translateY(" + self.Animation.interpolation(0, 100) + "%)"
        })
        self.bg.fadeOut()
      },
      function() {
        self.container.remove()
        self.bg.remove()
      }
    )
  }
}

module.exports = myCookie
