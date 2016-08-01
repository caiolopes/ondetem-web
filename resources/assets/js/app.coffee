window.$ = window.jQuery = require('jquery')

require('bootstrap-sass')

getCategories = ->
  placeCategory = $('#place-category')
  category = undefined
  vars = getUrlVars()
  if (vars.category != undefined)
    category = vars.category
  else if (placeCategory.length)
    category = placeCategory.val()

  $.getJSON '/categories', (data) ->
    html = ''
    $.each data, (index, value) ->
      if (category == value.category)
        html += '<option value="' + value.category + '" selected>' + value.category + '</option>'
      else
        html += '<option value="' + value.category + '">' + value.category + '</option>'
      return
    category = $('#category')
    category.html html
    category.on 'change', ->
      getTypes category.val()
      return
    getTypes category.val()
    return
  return

getTypes = (category) ->
  placeType = $('#place-type')
  type = undefined
  vars = getUrlVars()
  if (vars.type != undefined)
    type = vars.type
  else if (placeType.length)
    type = placeType.val()

  $.getJSON '/types?category=' + category, (data) ->
    html = ''
    $.each data, (index, value) ->
      if (value.id == type or value.type == type)
        html += '<option value="' + value.id + '" selected>' + value.type + '</option>'
      else
        html += '<option value="' + value.id + '">' + value.type + '</option>'
      return
    $('#type').html html
    return
  return

$(document).ready ->
  pathname = window.location.pathname;
  if (pathname == '/place' or pathname == '/places' or pathname == '/places/search')
    getCategories()
  else if (pathname.indexOf('/place/edit/') > -1)
    getCategories()

  if $('#message').length
    setTimeout(() ->
      $('#message').fadeOut('slow')
      return
    5000)

  $('#confirm-delete').on 'show.bs.modal', (e) ->
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))

  return

window.initMap = ->
  latitude = $('#latitude')
  longitude = $('#longitude')
  current = $('#current')
  marker = null
  drag = false

  map = new (google.maps.Map)(document.getElementById('map'),
    zoom: 12
    center:
      lat: -34.397
      lng: 150.644)

  lat = -22.005
  lng = -47.898
  map.setZoom 15

  if (latitude.length and longitude.length)
    drag = true
    if (latitude.val().length > 0 and longitude.val().length > 0)
      lat = latitude.val()
      lng = longitude.val()

  marker = new (google.maps.Marker)(
    position: new (google.maps.LatLng)(lat, lng)
    draggable: drag)

  map.setCenter marker.position
  marker.setMap map

  if (latitude.length and longitude.length)
    google.maps.event.addListener marker, 'dragend', (evt) ->
      current.html '<p>O lugar foi posicionado na latitude: ' + evt.latLng.lat().toFixed(3) + ' e longitude: ' + evt.latLng.lng().toFixed(3) + '</p>'
      latitude.val marker.getPosition().lat()
      longitude.val marker.getPosition().lng()
      return
    google.maps.event.addListener marker, 'dragstart', (evt) ->
      current.html '<p>Posicionando o lugar...</p>'
      return
    geocoder = new (google.maps.Geocoder)
    $('#search').click ->
      geocodeAddress geocoder, map, marker
      return
  return

geocodeAddress = (geocoder, resultsMap, marker) ->
  latitude = $('#latitude')
  longitude = $('#longitude')
  current = $('#current')

  address = document.getElementById('address').value
  geocoder.geocode { 'address': address }, (results, status) ->
    if status == google.maps.GeocoderStatus.OK
      resultsMap.setCenter results[0].geometry.location
      resultsMap.setZoom 15
      marker.setPosition results[0].geometry.location
      resultsMap.setCenter marker.position
      current.html '<p>O lugar foi posicionado na latitude: ' + marker.getPosition().lat().toFixed(3) + ' e longitude: ' + marker.getPosition().lng().toFixed(3) + '</p>'
      latitude.val marker.getPosition().lat()
      longitude.val marker.getPosition().lng()
    else
      alert 'Geocode was not successful for the following reason: ' + status
    return
  return

getUrlVars = ->
  vars = []
  hash = undefined
  hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&')
  i = 0
  while i < hashes.length
    hash = hashes[i].split('=')
    vars.push hash[0]
    vars[hash[0]] = hash[1]
    i++
  vars
