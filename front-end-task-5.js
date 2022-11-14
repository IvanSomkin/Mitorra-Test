const sortButton = document.getElementById("sort-button")
sortButton.onclick = function () {
  sortByHeight()
}

function sortByHeight() {
  let parent = document.getElementById("parent")

  let elementsArr = []
  for (let element of parent.children) {
    elementsArr.push(element)
  }

  function compareDescHeight(a, b) {
    return parseInt(b.style.height) - parseInt(a.style.height)
  }

  elementsArr.sort(compareDescHeight)

  while (parent.firstChild) {
    parent.removeChild(parent.firstChild)
  }

  for (let sortedElement of elementsArr) {
    parent.appendChild(sortedElement)
  }
}


const randomizeButton = document.getElementById("randomize-button")
randomizeButton.onclick = function () {
  randomize()
}

function randomize() {
  let parent = document.getElementById("parent")

  let elementsArr = []
  for (let element of parent.children) {
    elementsArr.push(element)
  }

  var n = elementsArr.length
  var tmpArr = []
  for (var i = 0; i < n - 1; i++) {
    tmpArr.push(elementsArr.splice(Math.floor(Math.random() * elementsArr.length), 1)[0])
  }
  tmpArr.push(elementsArr[0])
  elementsArr = tmpArr

  while (parent.firstChild) {
    parent.removeChild(parent.firstChild)
  }

  for (let sortedElement of elementsArr) {
    parent.appendChild(sortedElement)
  }
}