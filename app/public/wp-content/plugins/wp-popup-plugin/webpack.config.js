const path = require("path");

module.exports = {
  entry: "./react/index.js",
  output: {
    path: path.resolve(__dirname, "dist"),
    filename: "bundle.js",
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
        },
      },
      {
        test: /\.scss$/,
        use: ["style-loader", "css-loader", "sass-loader"], // Loaders untuk SCSS
      },
      {
        test: /\.(png|jpe?g|gif|webp)$/i, // Loaders untuk gambar
        use: [
          {
            loader: "file-loader",
            options: {
              name: "[name].[hash].[ext]", // Simpan dengan nama unik
              outputPath: "img/", // Simpan gambar di folder 'dist/images'
              publicPath: "/dist/", // Path yang digunakan di dalam kode
            },
          },
        ],
      },
    ],
  },
};
