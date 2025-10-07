const burger = document.querySelector('.navbar__burger')
const overlay = document.querySelector('.navbar__overlay')
const closeBtn = document.querySelector('.navbar__close')
const menu = document.getElementById('navbar-menu')

function initNav() {
  const isMobile = window.innerWidth <= 900
  const navbarLinks = document.querySelector('.navbar__links')
  const navbarExtras = document.querySelector('.navbar__extras')
  const navbarContainer = document.querySelector('.navbar__container')

  if (isMobile) {
    if (!menu.contains(navbarLinks)) menu.appendChild(navbarLinks)
    if (!menu.contains(navbarExtras)) menu.appendChild(navbarExtras)
  } else {
    if (!navbarContainer.contains(navbarLinks)) navbarContainer.appendChild(navbarLinks)
    if (!navbarContainer.contains(navbarExtras)) navbarContainer.appendChild(navbarExtras)
    closeNav()
  }
}

function openNav() {
  document.body.classList.add('nav-open')
  burger.setAttribute('aria-expanded', 'true')
  menu.setAttribute('aria-hidden', 'false')
}

function closeNav() {
  document.body.classList.remove('nav-open')
  burger.setAttribute('aria-expanded', 'false')
  menu.setAttribute('aria-hidden', 'true')
}

function toggleNav() {
  if (document.body.classList.contains('nav-open')) closeNav()
  else openNav()
}

window.addEventListener('DOMContentLoaded', () => {
  initNav()
  if (menu) {
    menu.addEventListener('click', e => {
      if (e.target.matches('a')) closeNav()
    })
  }
})

window.addEventListener('resize', initNav)
burger.addEventListener('click', toggleNav)
overlay.addEventListener('click', closeNav)
closeBtn.addEventListener('click', closeNav)
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeNav()
})

const langMenu = document.querySelector('.navbar__language')
const select = langMenu.querySelector('.select')
const options = langMenu.querySelector('.options')
const optionItems = langMenu.querySelectorAll('.option')

let isChanged = false
options.style.transition = 'opacity 301ms'
options.style.opacity = 0
options.style.display = 'none'

function showOptions() {
  if (isChanged) return
  isChanged = true
  options.style.display = 'flex'
  setTimeout(() => {
    options.style.opacity = 1
    isChanged = false
  }, 10)
}

function hideOptions() {
  if (isChanged) return
  isChanged = true
  options.style.opacity = 0
  setTimeout(() => {
    options.style.display = 'none'
    isChanged = false
  }, 301)
}

select.addEventListener('click', e => {
  e.stopPropagation()
  const visible = options.style.display === 'flex' && options.style.opacity === '1'
  if (visible) hideOptions()
  else showOptions()
})

optionItems.forEach(opt => {
  opt.addEventListener('click', e => {
    e.stopPropagation()
    select.innerHTML = opt.innerHTML
    hideOptions()
  })
})

document.addEventListener('click', e => {
  if (!langMenu.contains(e.target)) hideOptions()
})
