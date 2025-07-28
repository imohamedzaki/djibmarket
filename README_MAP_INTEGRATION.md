# Address Map Integration

This implementation adds interactive map functionality to the buyer addresses page, allowing users to select their location visually and automatically populate address fields.

## Current Implementation: OpenStreetMap + Leaflet

The current implementation uses **OpenStreetMap** with **Leaflet.js** which is completely free and doesn't require any API keys.

### Features:

-   Interactive map centered on Djibouti City by default
-   Enhanced search functionality with multiple search providers
-   Current location detection with GPS ("My Location" button)
-   Click or drag marker to select location
-   Automatic address field population from map selection
-   Reverse geocoding to get address details from coordinates
-   Persistent coordinate storage in database (latitude/longitude)
-   Shareable coordinates with copy/paste functionality
-   Direct links to Google Maps and WhatsApp sharing
-   Mobile-responsive design
-   Fallback search for better location finding
-   Exact coordinate preservation for location persistence

### Files Modified:

-   `resources/views/buyer/dashboard/addresses.blade.php` - Added map integration

## Alternative: Google Maps (Optional)

If you prefer to use Google Maps instead of OpenStreetMap, follow these steps:

### 1. Get Google Maps API Key

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the following APIs:
    - Maps JavaScript API
    - Places API
    - Geocoding API
4. Create credentials (API Key)
5. Restrict the API key to your domain for security

### 2. Replace the Map Implementation

Replace the Leaflet implementation in `addresses.blade.php` with:

```html
<!-- Replace Leaflet includes with Google Maps -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap"
    async
    defer
></script>
```

### 3. Update JavaScript Functions

You would need to update all the JavaScript functions to use Google Maps API instead of Leaflet.

## Usage Instructions for Users

1. **Search**: Type a location name in the search box and press Enter (improved search with multiple providers)
2. **Current Location**: Click "My Location" button to detect your GPS position
3. **Click**: Click anywhere on the map to place a marker
4. **Drag**: Drag the existing marker to a new location
5. **Auto-fill**: Address fields will automatically populate when you select a location
6. **Coordinates**: View exact latitude/longitude coordinates for the selected location
7. **Share**: Copy coordinates to clipboard or share via Google Maps/WhatsApp
8. **Persistence**: Coordinates are saved with your address and restored when editing

## Troubleshooting

### Map Not Loading

-   Check browser console for errors
-   Ensure internet connection is stable
-   Verify that the modal is fully opened before map initialization

### Search Not Working

-   The search uses Nominatim which has usage limits
-   Try more specific search terms
-   Ensure the location exists in OpenStreetMap data

### Address Fields Not Populating

-   Some locations may not have complete address data
-   You can manually fill in missing fields
-   Rural areas may have limited address information

## Customization

### Change Default Location

Modify the `djiboutiLocation` variable in the JavaScript:

```javascript
const djiboutiLocation = [YOUR_LATITUDE, YOUR_LONGITUDE];
```

### Adjust Map Styling

You can add different tile layers or styling by modifying the tile layer URL:

```javascript
L.tileLayer("DIFFERENT_TILE_SERVER_URL", {
    // options
}).addTo(map);
```

### Modify Search Bounds

Update the geocoding parameters to focus on different regions:

```javascript
geocodingQueryParams: {
    countrycodes: 'dj,et,er,so', // Add/remove country codes
    bounded: 1,
    viewbox: '42.3,10.9,43.6,12.7' // Adjust bounding box
}
```
