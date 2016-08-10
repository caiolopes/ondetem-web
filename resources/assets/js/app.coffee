window.$ = window.jQuery = require('jquery')

require('bootstrap-sass')
require('jquery.repeater')

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

$(document).ready ->
  getCategories = (edit = false) ->
    placeCategory = if edit then  $('.place-category').first() else $('.place-category').last()

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
      category = if edit then $('.category').first() else $('.category').last()
      category.html(html)
      category.on 'change', ->
        getTypes category.val(), edit
        return
      getTypes category.val(), edit
      return
    return

  getTypes = (category, edit = false) ->
    placeType = if edit then $('.place-type').first() else $('.place-type').last()
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
      if edit then $('.type').first().html(html) else $('.type').last().html(html)
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

  pathname = window.location.pathname;
  if (pathname == '/place' or pathname == '/places' or pathname == '/places/search')
    getCategories()
  else if (pathname.indexOf('/place/edit/') > -1)
    getCategories(true)

  if $('#message').length
    setTimeout(() ->
      $('#message').fadeOut('slow')
      return
    5000)

  $('#confirm-delete').on 'show.bs.modal', (e) ->
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))

  $('.repeater').repeater
    show: ->
      $(this).slideDown()
      getCategories()
      $(".category").eq(-2).prop('disabled', true)
      return
    hide: (deleteElement) ->
      $(".category").eq(-2).prop('disabled', false)
      $(this).slideUp deleteElement
      return
    isFirstItemUndeletable: true

  return
