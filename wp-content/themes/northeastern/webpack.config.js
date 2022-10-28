const path = require("path");
const webpack = require("webpack");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const SVGSpritemapPlugin = require("svg-spritemap-webpack-plugin");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const WebpackZipPlugin = require("webpack-zip-plugin");

const zipDist = new WebpackZipPlugin({
  frontShell: 'ls',
  initialFile: './dist',
  endPath: './dist',
  zipName: 'archive.zip',
  behindShell: ''
});

const extractSass = new ExtractTextPlugin({
  filename: "../css/style.css"
});

const spriteMap = new SVGSpritemapPlugin({
  prefix: "",
  src: "src/svg/*.svg",
  filename: "../img/svgstore.svg",
  styles: path.join(__dirname, "src/scss/util/_sprites.scss"),
  svg4everybody: true
});

const webpackPlugin = new webpack.ProvidePlugin({
  $: "jquery",
  jQuery: "jquery",
  waypoints: "waypoints"
});

const browserSync = new BrowserSyncPlugin(
  {
    files: ["dist/**/*"],
    server: "dist"
  },
  { reload: false }
  );

  module.exports = {
    devtool: "eval-source-map",
    entry: {
      main: "./src/index"
    },
    output: {
      filename: "[name].js",
      path: path.resolve(__dirname, "dist/js")
    },
    module: {
      rules: [
        {
          test: /\.html$/,
          include: path.resolve(__dirname, "src/html"),
          exclude: /node_modules/,
          use: [
            {
              loader: "file-loader",
              options: {
                name: "[name].html",
                outputPath: "../"
              }
            },
            {
              loader: "extract-loader"
            },
            {
              loader: "html-loader",
              options: {
                conservativeCollapse: false,
                removeAttributeQuotes: false
              }
            },
            {
              loader: "nunjucks-html-loader",
              options: {
                searchPaths: [
                  path.resolve(__dirname, "src/html"),
                  path.resolve(__dirname, "src/html/modules"),
                  path.resolve(__dirname, "src/html/templates"),
                  path.resolve(__dirname, "src/html/util")
                ]
              }
            }
          ]
        },
        {
          test: /\.js$/,
          include: path.resolve(__dirname, "src/js"),
          exclude: /node_modules/,
          use: {
            loader: "babel-loader",
            options: {
              presets: [
                [
                  "@babel/preset-env",
                  {
                    useBuiltIns: "usage"
                  }
                ]
              ]
            }
          }
        },
        {
          test: /\.scss$/,
          include: path.resolve(__dirname, "src/scss"),
          exclude: /node_modules/,
          use: extractSass.extract({
            fallback: "style-loader",
            use: [
              {
                loader: "css-loader",
                options: {
                  importLoaders: 2
                }
              },
              {
                loader: "postcss-loader",
                options: {
                  ident: "postcss",
                  parser: "postcss-scss",
                  plugins: () => [require("autoprefixer")]
                }
              },
              {
                loader: "sass-loader",
              }
            ]
          })
        },
        {
          test: /\.(woff|woff2|ttf)$/,
          include: path.resolve(__dirname, "src/fonts"),
          exclude: /node_modules/,
          use: [
            {
              loader: "file-loader",
              options: {
                name: "[name].[ext]",
                outputPath: "../fonts"
              }
            }
          ]
        },
        {
          test: /\.(png|jpg|gif|svg|mp4)$/,
          include: path.resolve(__dirname, "src/img"),
          exclude: /node_modules/,
          use: {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "../img"
            }
          }
        },
        {
          test: /\.(css)$/,
          include: path.resolve(__dirname, "src/css"),
          exclude: /node_modules/,
          use: {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "../css"
            }
          }
        },
        {
          test: /\.json$/,
          include: path.resolve(__dirname, "src/js"),
          exclude: /node_modules/,
          type: "javascript/auto",
          use: {
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "../js"
            }
          }
        }
      ]
    },
    plugins: [
      extractSass,
      spriteMap,
      webpackPlugin,
      browserSync,
      new CleanWebpackPlugin(["dist"]),
      // zipDist
    ],
    watch: true
  };
