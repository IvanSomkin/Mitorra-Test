const OPTION_MENU_LEAVE = "option-menu-leave"
const MAIN_MENU_LEAVE = "main-menu-leave"
const OPTION_MENU_OVER = "option-menu-over"


window.onload = function () {
  const menu = document.getElementById("menu")
  configureMenu(menu)
}


function configureMenu(menu) {
  const mainMenu = document.getElementById("main-menu")
  const mainMenuOptions = mainMenu.getElementsByTagName("a")
  const optionMenus = document.getElementsByClassName("option-menu")

  configureMainMenu(menu, mainMenu, optionMenus)
  for (let option of mainMenuOptions) {
    const optionMenu = document.getElementById(option.id + "-menu")
    configureOptionMenu(menu, mainMenu, option, optionMenu, optionMenus)
  }
}


function configureMainMenu(menu, mainMenu, optionMenus) {
  mainMouseOver(menu, mainMenu)
  mainMouseLeave(menu, mainMenu, optionMenus)
}

function mainMouseOver(menu, mainMenu) {
  mainMenu.addEventListener("mouseover", function () {
    menu.classList.remove("main-menu-leave")
  })
}

function mainMouseLeave(menu, mainMenu, optionMenus) {
  mainMenu.addEventListener("mouseleave", function () {
    menu.classList.add("main-menu-leave")
    checkMenuMouseLeave(menu, optionMenus)
  })
}


function configureOptionMenu(menu, mainMenu, option, optionMenu, optionMenus) {
  optionMouseOver(mainMenu, option, optionMenu, optionMenus)
  optionMenuMouseOver(menu, optionMenu)
  optionMenuMouseLeave(menu, optionMenu, optionMenus)
}

function optionMouseOver(mainMenu, option, optionMenu, optionMenus) {
  option.addEventListener("mouseover", function () {
    showOptionMenuHideOthers(mainMenu, optionMenu, optionMenus)
  })
}

function optionMenuMouseOver(menu, optionMenu) {
  optionMenu.addEventListener("mouseover", function () {
    menu.classList.add("option-menu-over")
  })
}

function optionMenuMouseLeave(menu, optionMenu, optionMenus) {
  optionMenu.addEventListener("mouseleave", function () {
    menu.classList.remove("option-menu-over")
    checkMenuMouseLeave(menu, optionMenus)
  })
}


function showOptionMenuHideOthers(mainMenu, optionMenu, optionMenus) {
  hideOptionMenus(optionMenus)
  showOptionMenu(mainMenu, optionMenu)
}

function hideOptionMenus(optionMenus) {
  for (let optionMenu of optionMenus) {
    optionMenu.style.top = "0px"
  }
}

function showOptionMenu(mainMenu, optionMenu) {
  const mainMenuHeight = mainMenu.getBoundingClientRect().height
  optionMenu.style.top = mainMenuHeight + "px"
}



function checkMenuMouseLeave(menu, optionMenus) {
  setTimeout(function () {
    if (menu.classList.contains(MAIN_MENU_LEAVE) && !menu.classList.contains(OPTION_MENU_OVER)) {
      hideOptionMenus(optionMenus)
    }
  }, 100)
}









