-- Create the database
CREATE DATABASE IF NOT EXISTS cupo_db;

-- Use the database
USE cupo_db;

-- Create the 'products' table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    category VARCHAR(255) NOT NULL,
    ingredients VARCHAR(255) NOT NULL,
    allergens VARCHAR(255) NOT NULL,
    vegetarian INT NOT NULL,
    perishability INT NOT NULL,
    valability INT NOT NULL,
    region VARCHAR(255) NOT NULL,
    stores VARCHAR(255) NOT NULL,
    quantity VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    originOfIngredients VARCHAR(255) NOT NULL,
    packaging VARCHAR(255) NOT NULL,
    NutriScore VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- Create the 'users' table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    emailAdress VARCHAR(255) NOT NULL UNIQUE,
    phoneNumber VARCHAR(255) NOT NULL UNIQUE,
    passwrd VARCHAR(255) NOT NULL,
    vegetarian INT NOT NULL,
    admin INT NOT NULL,
    allergens VARCHAR(255),
    session_token VARCHAR(255),
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    session_expiry TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the 'lists' table
CREATE TABLE IF NOT EXISTS lists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the 'items' table
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    list_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    FOREIGN KEY (list_id) REFERENCES lists(id) ON DELETE CASCADE
);


-- Create the 'preferences' table
CREATE TABLE IF NOT EXISTS preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    preference_name VARCHAR(255) NOT NULL,
    preference_value VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    count INT DEFAULT 1
);
INSERT INTO users (id, firstName, lastName, emailAdress, phoneNumber, passwrd, admin) 
VALUES (1, 'Maricica', 'Maria', 'maricica@gmail.com', '0769999999', PASSWORD('cevaparola'), 0); 

INSERT INTO lists(name, user_id) VALUES ('Favourites', 1); 
 
INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Orangesaft', 3.5, 'Juices and nectars', 'orange juice', '-', 1, 3, 100,
'France', 'Magasins U', '1l', 'Tropicana', 'India', 'plastic bottle', 'C', 'Orangesaft.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Coca-Cola Zero', 8.5, 'Sodas', 'water, carbon dioxide, color: 150d,
sweeteners: sodium cyclamate, acesulfame K and aspartame, caffeine, phenylalanine', '-', 1, 2, 300, 'Australia', 'Auchan',
'2l', 'Coca-Cola', 'Australia', 'plastic bottle', 'C', 'Coca-Cola.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Ciao Peach', 10.3, 'Juices and nectars', 'water, peach juice,
glucose-fructose syrup, citric acid, sodium carboxymethylcellulose, flavours, vitamin c', '-', 1, 2, 100, 'Romania', 
'Lidl', '2l', 'Ciao', 'Romania', 'cardboard box', 'C', 'Ciao.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Tedi', 4.5, 'Juices and nectars', 'water, puree (40%) from: carrot (36%), apple 3%) 
and raspberry (1%), sugar, glucose-fructose syrup, citric acid, vitamin C, flavors', 'apple', 1, 1, 300, 'Romania', 'Kaufland',
'300ml', 'Tedi', 'Romania', 'clear glass bottle', 'E', 'Tedi.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Fanta', 5.5, 'Sodas', 'carbonated water sugar orange juice from concentrate (3,7%) 
citrus fruits from concentrate (1,3%), citric acid, malic acid, absorbic acid, sodium citrate', 'nuts', 1, 3, 350, 'Belgium',
'Magasins U', '500ml', 'Fanta', 'France', 'plastic bottle', 'D', 'Fanta.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Tiramisu', 13.5, 'Desserts', 'water, sugar, milk, flour, mascarpone',
'eggs, gluten, milk', 0, 1, 3, 'France', 'E.Leclerc', '320g', 'Marque Repère - Délisse', 'France', 'cardboard', 'E', 'Tiramisu.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Cheesecake', 20.3, 'Cheesecakes', 'cheese, flour, sugar, milk, water',
'gluten, milk', 0, 1, 2, 'France', 'Picard', '190g', 'Picard', 'France', 'cardboard', 'E', 'Cheesecake.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Kinder Bueno', 4.3, 'Sweet snacks', 'milk chocolate juice', 'gluten, milk, nuts',
0, 1, 300, 'Portugal', 'Carrefour', '43g', 'Kinder', 'Portugal', 'plastic', 'E', 'KinderBueno.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Belvita', 14.2, 'Snacks', 'grains of 56,6%, sugar, cocoa powder, baking powder',
'gluten, milk, soybeans', 0, 2, 200, 'Belgium', 'Carrefour', '400g', 'Mondelez', 'Belgium', 'box', 'D', 'Belvita.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Oreo', 4.9, 'Sweet snacks', 'wheat flour, sugar, palm oil, rapeseed oil, 
low-fat cocoa pulp 4,3%, wheat starch, glucose-fructose syrup', 'gluten, soybeans', 1, 2, 200, 'Germany', 'Cora', '154g',
'Mondelez', 'Germany', 'composite-carton', 'E', 'Oreo.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Ferrero Rocher', 25.0, 'Sweet snacks', 'milk chocolate 30%, hazelnuts, 
sugar, palm oil, wheat flour', 'gluten, milk, nuts, soybeans', 0, 2, 200, 'Australia', 'Carrefour', '200g', 'Ferrero Rocher',
'Australia', 'plastic', 'E', 'FerreroRocher.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Speculoos', 12.5, 'Sweet snacks', 'flour, sugar, palm oil', 'gluten', 0,
2, 200, 'France', 'Lidl', '500g', 'Sondey', 'France', 'cardboard', 'E', 'Speculoos.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Panettone', 20.5, 'Sweet snacks', 'wheat flour, 15% raisins, 14% eggs, 12% 
candied orange peel, butter', 'gluten, milk, eggs', 0, 2, 10, 'Spain', 'Lidl', '1kg', 'Favorina', 'Italy', 'cardboard', 'E', 'Panettone.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Twix Twin', 3.9, 'Snacks', 'sugar, glucose syrup, wheat flour, palm fat, cocoa butter,
skimmed milk powder, cocoa mass, lactose, milk fat, whey powder (from milk), fat reduced cocoa, salt', 'gluten, milk, soybeans', 0, 2,
200, 'Belgium', 'Carrefour', '50g', 'Mars Wrigley', 'Belgium', 'plastic bag', 'E', 'Twix.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Space Cookies', 29.9, 'Breakfast cereals', '49.9% of flour, sugar and 11.5%, 
corn grits, glucose syrup, wheat starch, 3.1% of milk chocolate,  oat fiber , 1.6% of cocoa with reduced fat content, 0.8% of cocoa', 
'gluten, milk', 0, 4, 300, 'Poland', 'Lidl', '250g', 'Crownfield', 'Poland', 'plastic bag', 'C', 'SpaceCookies.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Mini Granola', 30.2, 'Sweet snacks', 'wheat flour, sugar, palm oil, cocoa paste,
cocoa butter, baking powder, milk', 'gluten, milk, soybeans', 1, 4, 200, 'France', 'Magasins U', '160g', 'Lu', 'France',
'cardboard', 'E', 'Granola.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Hobbits Kernig', 23.5, 'Sweet snacks', 'oatmeal 31%, wheat wholemeal flour 30%, 
sugar, palm oil, salt', 'eggs, gluten, milk', 0, 2, 200, 'Spain', 'Carrefour', '250g', 'Brandt', 'Spain', 'plastic', 'E', 'Hobbits.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Fig Rolls', 13.4, 'Sweet snacks', '32% figs, fortified wheat flour, sugar, palm oil, 
glucose synup, partially inverted sugar syrup, whey powder', 'milk, gluten', 0, 3, 50, 'France', 'Lidl', '200g', 'Lidl', 'France', 'paper',
'D', 'Fig.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Californian Almond', 3.5, 'Nuts', 'Nuts', 'nuts', 1, 3, 40, 'Romania', 'Lidl',
'200g', 'Alesto', 'California', 'plastic bag', 'A', 'Alesto.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Nutline Nuts', 5.5, 'Nuts', 'Nuts', 'nuts', 1, 2, 30, 'Romania', 'Carrefour', 
'135g', 'Nutline', 'Romania', 'plastic bag', 'C', 'Nutline.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Mediterranean Nutty Almond Milk', 30.3, 'Milk substitutes', 'water, almond (2.3%), sugar,
tri-calcium phosphate, sea salt, stabilisers (locust bean gum, gellan gum), emulsifier (lecithins (sunflower), natural flavouring, vitamins (B2, B12, E, D2)',
'nuts', 1, 2, 4, 'United Kingdom', 'Kaufland', '1l', 'Alpro', 'Spain', 'cardboard', 'C', 'Alpro.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Bebida de avena', 29.9, 'Milk substitutes', 'water, oatmeal', '-', 1, 1, 2,
'Portugal', 'Mercadona', '1l', 'ALITEY', 'Portugal', 'Tetra Brik', 'C', 'Bebida.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Nordic Oat Drink', 25.6, 'Milk substitutes', 'water, organic oats (13%), organic rapeseed oil, 
salt', 'gluten', 1, 1, 2, 'United Kingdom', 'ASDA', '1l', 'Jörd', 'United Kingdom', 'cardboard', 'C', 'Nordic.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Bio sweetened soy milk', 25.5, 'Milk substitutes', 'water, sugar, soybeans', 'gluten, soybeans',
1, 2, 3, 'Germany', 'Lidl', '1l', 'Vemondo', 'European Union', 'cardboard', 'B', 'Vemondo.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Greek Yogurt 5%', 14.3, 'Yogurts', 'pasteurised skimmed milk, cream, live active 
yoghurt cultures, no palm oil', 'milk', 0, 1, 2, 'Greece', 'Carrefour', '50g', 'Fage', 'Luxembourg', 'cardboard', 'B', 'Fage.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Creamy Greek Style Natural Yogurt', 40.3, 'Yogurts', 'milk', 'milk', 1, 1, 2,
'United Kingdom', 'Lidl', '1kg', 'Milbona', 'United Kingdom', 'plastic', 'C', 'Creamy.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Divin Greek Yogurt 2%', 30.8, 'Yogurts', 'pasteurised skimmed milk, live
active yoghurt cultures', 'milk', 1, 2, 30, 'Romania', 'Carrefour', '150g', 'Zuzu', 'Romania', 'plastic', 'A', 'Zuzu.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Greek style - Yeo Valley', 20.2, 'Yogurts', 'organic greek style yogurt, organic honey,
organic sugar, organic tapioca starch', 'milk', 1, 1, 20, 'United Kingdom', 'Carrefour', '450g', 'Yeo Valley', 'United Kingdom', 'plastic', 
'C', 'Yeo.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Fat Greek Yogurt 0%', 40.1, 'Yogurts', 'milk', 'milk', 1, 2, 20, 'Ireland',
'Tesco', '150g', 'Tesco Finest', 'Ireland', 'plastic', 'A', 'Tesco.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Greek style yogurt', 30.5, 'Yogurts', 'greek style yogurt', 'milk', 1, 1, 20,
'United Kingdom', 'Waitrose', '1kg', 'Waitrose', 'United Kingdom', 'plastic', 'C', 'Waitrose.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Jamón Serrano', 20.2, 'Hams', 'pork ham, salt, sugar, antioxidants (e-331, e-301)
and preservatives (e-252, e-250)', 'pork', 0, 2, 20, 'Spain', 'Carrefour', '120g', 'Incarlopsa', 'Spain', 'plastic', 'E', 'Incarlopsa.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Jamón cocido extra', 25.4, 'Hams', 'ham (85%), water, salt, glucose syrup, stabilizers',
'-', 0, 2, 10, 'Spain', 'Hacendado', '225g', 'Hacendado', 'Spain', 'plastic', 'C', 'Jamon.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Heck pork sausages', 15.4, 'Sausages', 'british pork (97%), seasoning (salt, 
rice flour, spices, preservative (sodium SULPHITE)', 'sulphur dioxide and sulphites', 0, 2, 5, 'France', 'Carrefour', '400g', 'Heck', 'United Kingdom',
'Mixed plastic-sleeve', 'E', 'Heck.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Tofu Wiener', 40.5, 'Meat alternatives', 'tofu 75%, soy sauce, oats, sea salt',
'gluten, soybeans', 0, 2, 10, 'Greece', 'Ekoplaza', '300g', 'Taifun', 'Greece', 'plastic', 'D', 'Tofu.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Frankfurt original', 12.5, 'Sausages', 'mechanically separated meat from chicken, pork fat,
water, salt, dextrose, starch, stabilizers, spices and aromas', 'milk', 0, 2, 10, 'Spain', 'Carrefour', '140g', 'Campofrio', 'Spain', 'plastic',
'D', 'Frankfurt.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Vegetarian Meatballs', 15.4, 'Meat alternatives', 'rehydrated textured soya protein (53%),
 rapeseed oil, basil, tomato purée, soya protein concentrate', 'soybeans', 1, 2, 5, 'France', 'Carrefour', '240g', 'Rythmn 108', 'France',
 'plastic', 'A', 'Veg.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Huvudroll Plant Balls Frozen', 20.9, 'Meat alternatives', 'pea protein (30 %), water,
rapeseed oil, potatoes, binding mixes, onion, oat bran', 'gluten', 1, 2, 5, 'Austria', 'IKEA', '500g', 'IKEA', 'Netherlands', 'plastic', 'C', 'Ikea.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Meat Free Meatball Mix', 20.5, 'Meat alternatives', 'textured wheat protein, wheat gluten,
flour, garlic powder, citrus fibre, tomato powder', 'gluten', 1, 2, 5, 'United Kingdom', 'Carrefour', '120g', 'Paxo', 'United Kingdom', 'plastic', 'A',
'Meatball.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Pain De Mie Bio', 40.5, 'Breads', 'wheat flour, water, whole wheat flour 13%,
foux cane sugar, yeast, rapeseed oil, apple cider vinegar, wheat bran, salt, wheat gluten', 'gluten', 1, 2, 4, 'Switzerland', 'Carrefour', 
'500g', 'La Boulangère Bio', 'France', 'plastic bag', 'C', 'BioBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('American Sandwich Nature', 23.3, 'Breads', 'wheat flour 65%, water, sugar, rapeseed oil,
salt, vinegar, yeast, flour of beans, wheat gluten, flavor (contains alcohol), extract of acerola, may contain traces of eggs, soya, milk',
'gluten, eggs, milk, nuts, sesame seeds', 1, 1, 2, 'France', 'Carrefour', '550g', 'Harrys', 'France', 'plastic bag', 'C', 'AmericanBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Grilletines blé complet', 22.2, 'Breads', 'wheat flour 62%, wholegrain cereals 16%,
sunflower oil, sugar, wheat bran, yeast, wheat gluten , skimmed milk powder, malted barley flour, salt', 'gluten, milk, eggs, sesame seeds',
1, 2, 4, 'France', 'Carrefour', '242g', 'Pasquier', 'France', 'plastic bag', 'C', 'FrenchBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Le pain des fleurs', 33.4, 'Breads', 'buckwheat flour, cane sugar complete, 
sea salt - from organic farming', '-', 1, 1, 2, 'Spain', 'Botanic', '300g', 'Le pain des fleurs', 'France', 'plastic bag', 'A', 'PainBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Weizentoast', 44.5, 'Breads', '65% wheat flour, water, sugar, rapeseed oil, salt, 
bean flour, yeast, flavor, alcohol', 'gluten', 1, 2, 4, 'Czech Republic', 'Lidl', '500g', 'Maitre Jean Pierre', 'France', 'sachet', 'C', 'CzechBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('The Original', 40.0, 'Breads', 'wheat flour, water, yeast, sugar, spirit vinegar, maize,
salt, sweet potato puree', 'gluten', 1, 2, 4, 'United Kingdom', 'Tesco', '500g' ,'New York Bakery', 'United Kingdom', 'plastic bag', 'A', 'NewYorkBread.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Chicken Flavour', 5.5, 'Soups', 'wheat flour, palm oil, tapioca starch, salt, 
vegetables, chicken flavor, flavor enhancer: e621, e635, sugar, spices(chili, pepper), e415, e466e500, e452, e451', 'gluten, soybeans', 0, 2, 200,
'Denmark', 'Kaufland', '60g', 'YumYum', 'Thailand', 'plastic bag', 'C', 'yum.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Cream of Tomato Soup', 13.0, 'Soups', 'tomatoes 84%, water, vegetable oil, sugar,
modified corn flour, salt, dried skimmed milk, milk proteins, cream, spice extracts, herbs extract, citric acid', 'milk', 0, 1, 20, 'Denmark',
'Tesco', '400g', 'Heinz', 'England', 'plastic bag', 'A', 'Heinz.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Shrimp Flavour', 6.0, 'Soups', 'wheat flour, palm oil, salt, sugar, tapioca starch,
garlic, chilli 0.9%, flavour enhancers: E621, E635, acid: E330', 'celery, crustaceans, fish, gluten, sesame seeds, soybeans', 0, 1, 45, 'Finland',
'Prisma', '60g', 'YumYum', 'Thailand', 'plastic bag', 'C', 'Shrimp.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Sun-dried Tomatoes', 34.5, 'Soups', '75% sun-dried tomatoes, water, 5% iodised 
sea salt (sea salt, potassium iodate)', '-', 1, 1, 5, 'Slovakia', 'Lidl', '1kg', 'Italiamo', 'Italy', 'plastic bag', 'B', 'ItSoup.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Classic Chicken soup', 23.4, 'Soups', 'water, potato 20%, onion, chicken 5%, 
single cream (milk), roast chicken stock, cornflour, salted butter', 'chicken, milk', 0, 1, 2, 'United Kingdom', 'Lidl', '560g', 
'Covent Garden', 'United Kingdom', 'composite carton', 'C', 'Chicken.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Lentil Spinach Dhal Soup', 40.2, 'Soups', 'water, chopped tomatoes, red lentils (11%), 
spinach (8%), onion, creamed coconut, vegetable bouillon', 'red lentils', 1, 1, 2, 'United Kingdom', 'Carrefour', '600g', 'Tideford', 
'United Kingdom', 'plastic container', 'B', 'Lentil.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Nutella', 12.5, 'Chocolate spreads', 'sugar, palm oil, hazelnuts (13%), skimmed 
milk powder (8,7%), reduced-fat cocoa powder (7,4%), emulsifier: lecithins (soybeans), vanillin', 'milk, nuts, soybeans', 0, 1, 35, 'Austria',
'Carrefour', '200g', 'Nutella', 'Austria', 'pot', 'E', 'Nutella.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Cacao noir intense 70%', 15.0, 'Chocolates', 'cocoa paste, sugar, cocoa butter, 
vanilla', 'milk, nuts, soybeans', 0, 1, 45, 'Morocco', 'Magasins U', '100g', 'Lindt', 'France', 'cardboard', 'E', 'Lindt.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Dark Chocolate - 85% Cocoa', 23.5, 'Chocolates', 'cocoa mass, fat reduced cocoa powder,
cocoa butter, sugar, soya lecithins, vanilla extract', 'soybeans, nuts', 0, 1, 5, 'Estonia', 'Lidl', '125g', 'J. D. Gross', 'France', 'cardboard',
'D', 'Gross.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Nestle Dessert', 16.5, 'Chocolates', 'sugar, cocoa paste, cocoa butter, emulsifier 
sunflower lecithin, natural vanilla aroma madagascar, cocoa: 52%', 'milk, nuts', 0, 1, 5, 'Belgium', 'Carrefour', '205g', 'Nestle', 'Madagascar',
'cardboard', 'E', 'Nestle.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Mints', 13.6, 'Chocolates', 'sugar, cocoa mass, glucose syrup, cocoa butter, butter oil,
peppermint oil', 'milk, soybeans', 0, 1, 10, 'Bulgaria', 'Aldi', '200g', 'Hatherwood', 'Germany', 'cardboard', 'D', 'Mints.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Chocolat Noisette', 20.2, 'Chocolate spreads', 'cane sugar, sunflower oil, 
chocolate 16, 5 % cane sugar, cocoa powder, lean cocoa butter, mashed potatoes, hazelnut', 'milk, nuts, soybeans', 0, 1, 10, 'Guadeloupe', 
'Magasins U', '350g', 'Jardin bio', 'France', 'pot', 'E', 'Noisette.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Nastro Azzurro 0.0%', 15.8, 'Beer', 'water, barley malt, Italian corn grits, 
hops, natural flavors', 'corn', 1, 1, 5, 'Sweden', 'Willys', '330ml', 'Peroni', 'Italy', 'bottle', 'D', 'Peroni.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Ciucas', 9.9, 'Beer', 'water, barley, wheat', 'gluten', 1, 1, 15, 'Romania', 'Kaufland',
'330ml', 'Ciucas', 'Romania', 'plastic bottle', 'D', 'Ciucas.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Cerveza Especial', 15.7, 'Beer', 'water, malt (barley), maize, hops', 'malt', 1,
1, 10, 'Morocco', 'Mercadona', '330ml', 'San Miguel', 'Morocco', 'green dot', 'D', 'Cerveza.jpg');

INSERT INTO products(name, price, category, ingredients, allergens, vegetarian, perishability, valability, region, stores, quantity, brand,
originOfIngredients, packaging, NutriScore, image) VALUES('Corona Cero', 23.5, 'Beer', 'water, barley malt, maize, sugar, hops, natural flavours',
'gluten', 1, 1, 10, 'United Kingdom', 'Lidl', '330ml', 'Corona', 'United Kingdom', 'bottle', 'D', 'Corona.jpg');