var fontFamilies = [

  {

    fontFamily: 'Oxygen',

    weights: [400, 700],

    styles: 'normal'

  }

];

var fontObs = [];



var isModernBrowser = (

  'querySelector' in document &&

  'localStorage' in window &&

  'addEventListener' in window

);



for (i=0; i<fontFamilies.length; i++) {

  var fontFamily = (typeof fontFamilies[i] == 'string') ? fontFamilies[i] : fontFamilies[i].fontFamily;

  var fontName = fontFamily.toLowerCase().replace(' ', '-');

  if (sessionStorage.getItem('awi-fonts-loaded-' + fontName) == 'loaded') document.documentElement.className += " " + fontName + "-font-loaded";

}



var currentFontLoading = '';

var totalFontsLoading = -1;

for (i=0; i<fontFamilies.length; i++) {

  if (typeof fontFamilies[i] == 'string') {

    if (currentFontLoading !== fontFamilies[i]) {

      fontObs.push([]);

      totalFontsLoading++;

      currentFontLoading = fontFamilies[i];

    }

    fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i]));

  } else {

    if (currentFontLoading !== fontFamilies[i].fontFamily) {

      fontObs.push([]);

      totalFontsLoading++;

      currentFontLoading = fontFamilies[i].fontFamily;

    }

    if (fontFamilies[i].hasOwnProperty('weights') && fontFamilies[i].hasOwnProperty('styles')) {

      if (typeof fontFamilies[i].weights == 'number' && typeof fontFamilies[i].styles == 'string') {

        fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights, style: fontFamilies[i].styles }));

      } else if (typeof fontFamilies[i].weights == 'number') {

        for (var x = 0; x < fontFamilies[i].styles.length; x++) {

          fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights, style: fontFamilies[i].styles[x] }));

        }

      } else if (typeof fontFamilies[i].styles == 'string') {

        for (var x = 0; x < fontFamilies[i].weights.length; x++) {

          fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights[x], style: fontFamilies[i].styles }));

        }

      } else {

        for (var x = 0; x < fontFamilies[i].weights.length; x++) {

          for (var y = 0; y < fontFamilies[i].styles.length; y++) {

            fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights[x], style: fontFamilies[i].styles[y] }));

          }

        }

      }

    } else if (fontFamilies[i].hasOwnProperty('weights')) {

      if (typeof fontFamilies[i].weights == 'number') {

        fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights }));

      } else {

        for(var x = 0; x<fontFamilies[i].weights.length; x++) {

          fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { weight: fontFamilies[i].weights[x] }));

        }

      }

    } else if (fontFamilies[i].hasOwnProperty('styles')) {

      if (typeof fontFamilies[i].styles == 'string') {

        fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { style: fontFamilies[i].styles }));

      } else {

        for(var x = 0; x<fontFamilies[i].styles.length; x++) {

          fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily, { style: fontFamilies[i].styles[x] }));

        }

      }

    } else {

      fontObs[totalFontsLoading].push(new FontFaceObserver(fontFamilies[i].fontFamily));

    }

  }

}



for (var i = 0; i < fontObs.length; i++) {

  var loadFonts = [];

  for (var x = 0; x < fontObs[i].length; x++) {

    loadFonts.push(fontObs[i][x].load(null, 6000));

  }

  Promise.all(loadFonts).then(function(data) {

    var fontName = data[0]['family'].toLowerCase().replace(' ', '-');

    document.documentElement.className += " " + fontName + "-font-loaded";

    sessionStorage.setItem('awi-fonts-loaded-' + fontName, 'loaded');

  }, function(data) {

    console.log('Font "' + (data[0].family ? data[0].family : fontFamilies[i]) + '" did not load');

  });

}

