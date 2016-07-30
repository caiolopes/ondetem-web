window.$ = window.jQuery = require('jquery')

require('bootstrap-sass')

getCategories = ->
  category = undefined
  vars = getUrlVars()
  if (vars.category != undefined)
    category = vars.category

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
  type = undefined
  vars = getUrlVars()
  if (vars.type != undefined)
    type = vars.type

  $.getJSON '/types?category=' + category, (data) ->
    html = ''
    $.each data, (index, value) ->
      if (value.id == type)
        html += '<option value="' + value.id + '" selected>' + value.type + '</option>'
      else
        html += '<option value="' + value.id + '">' + value.type + '</option>'
      return
    $('#type').html html
    return
  return

$(document).ready ->
  pathname = window.location.pathname;
  if (pathname.indexOf('place/add') > -1 or pathname.indexOf('places') > -1 or pathname.indexOf('places/search') > -1)
    getCategories()

  if $('#message').length
    setTimeout(() ->
      $('#message').fadeOut('fast')
      return
    5000)
  return

marker = null
window.initMap = ->
  map = new (google.maps.Map)(document.getElementById('map'),
    zoom: 11
    center:
      lat: -34.397
      lng: 150.644)
  if marker == null
    marker = new (google.maps.Marker)(
      position: new (google.maps.LatLng)(-22.005, -47.898)
      draggable: true)
  map.setCenter marker.position
  marker.setMap map
  google.maps.event.addListener marker, 'dragend', (evt) ->
    document.getElementById('current').innerHTML = '<p>O lugar foi posicionado na latitude: ' + evt.latLng.lat().toFixed(3) + ' e longitude: ' + evt.latLng.lng().toFixed(3) + '</p>'
    document.getElementById('latitude').value =  marker.getPosition().lat()
    document.getElementById('longitude').value =  marker.getPosition().lng()
    return
  google.maps.event.addListener marker, 'dragstart', (evt) ->
    document.getElementById('current').innerHTML = '<p>Posicionando o lugar...</p>'
    return
  geocoder = new (google.maps.Geocoder)
  document.getElementById('search').addEventListener 'click', ->
    geocodeAddress geocoder, map
    return
  return

geocodeAddress = (geocoder, resultsMap) ->
  address = document.getElementById('address').value
  geocoder.geocode { 'address': address }, (results, status) ->
    if status == google.maps.GeocoderStatus.OK
      resultsMap.setCenter results[0].geometry.location
      resultsMap.setZoom 15
      marker.setPosition results[0].geometry.location
      resultsMap.setCenter marker.position
      document.getElementById('current').innerHTML = '<p>O lugar foi posicionado na latitude: ' + marker.getPosition().lat().toFixed(3) + ' e longitude: ' + marker.getPosition().lng().toFixed(3) + '</p>'
      document.getElementById('latitude').value =  marker.getPosition().lat()
      document.getElementById('longitude').value =  marker.getPosition().lng()
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