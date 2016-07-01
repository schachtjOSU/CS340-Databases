-- Beer Table insert

-- name: Big Bertha
-- alc %: 11.5

-- name: Sunny Day Porter
-- alc %: 10

-- name: DJ Jazzy Hef
-- alc %: 8

-- name: Black Mamba
-- alc %: 11.5

INSERT INTO beer (BeerName, Alc) VALUES ('Big Bertha', '11.5'), ('Sunny Day Porter', '10'),('DJ Jazzy Hef', '8'), ('Black Mamba', '10.5');

-- Hop table insert- Got all of the data below from https://www.morebeer.com/category/brewing-ingredients.html

-- bid: Sonny Day Porter
-- name: Weyermann Rauch
-- date_picked: '2016-01-01'
-- date_expired: '2017-01-31'
-- weight_oz: 45
-- nation_grown: Germany
-- form: Malt

INSERT INTO hop (BNum,HopName,DatePick,DateExpired,WeightOz,NationGrown,Form) 
(SELECT b.BNum,'Weyermann Rauch','2016-01-01','2017-01-31',45,'Germany','Whole Leaf' FROM beer b WHERE b.BeerName='Sunny Day Porter' LIMIT 1);

-- bid: Big Bertha
-- name: Castle Belgian Biscuit
-- date_picked: '2015-01-01'
-- date_expired: '2017-07-31'
-- weight_oz: 50
-- nation_grown: 
-- form: Malt

INSERT INTO hop (BNum,HopName,DatePick,DateExpired,WeightOz,NationGrown,Form) 
(SELECT b.BNum,'Castle Belgian Biscuit','2015-01-01','2018-07-31',50,'Germany','Pellet' FROM beer b WHERE b.BeerName='Big Bertha' LIMIT 1);

-- bid: DJ Jazzy Hef
-- name: Great Western White Wheat
-- date_picked: '2016-03-01'
-- date_expired: '2019-01-31'
-- weight_oz: 65
-- nation_grown: US
-- form: Wheat Malt

INSERT INTO hop (BNum,HopName,DatePick,DateExpired,WeightOz,NationGrown,Form) 
(SELECT b.BNum,'Great Western White Wheat','2016-01-01','2017-01-31',65,'US','Pellet' FROM beer b WHERE b.BeerName='DJ Jazzy Hef' LIMIT 1);

-- bid: Black Mamba
-- name: Fawcett Optic
-- date_picked: '2015-07-01'
-- date_expired: '2019-08-31'
-- weight_oz: 60
-- nation_grown: United Kingdom
-- form: Malt

INSERT INTO hop (BNum,HopName,DatePick,DateExpired,WeightOz,NationGrown,Form) 
(SELECT b.BNum,'Fawcett Optic','2015-07-01','2019-08-31',60,'United Kingdom','Whole Leaf' FROM beer b WHERE b.BeerName='Black Mamba' LIMIT 1);

-- ingredient table insert
-- name:Mill Grain
-- name:Yeast
-- name:Black Tea
-- name:Cinnamon
-- name:Pumpkin Pie Spice
-- name:Orange Peel
-- name:Spice
-- name:Sugar
INSERT INTO ingredient (InName) VALUES ('Sugar'),('Mill Grain'),('Yeast'),('Black Tea'),('Cinnamon'),('Pumpkin Pie Spice'),('Orange Peel'),('Spice');

-- ingredient table insert
-- bid- DJ Jazzy Hef
-- name- Jazzy
INSERT INTO recipe (BNum,RName) (SELECT b.BNum,'Jazzy' FROM beer b WHERE b.BeerName='DJ Jazzy Hef' LIMIT 1);

-- bid- Big Bertha
-- name- Bertha
INSERT INTO recipe (BNum,RName) (SELECT b.BNum,'Bertha' FROM beer b WHERE b.BeerName='Big Bertha' LIMIT 1);

-- bid- Black Mamba
-- name- Mamba
INSERT INTO recipe (BNum,RName) (SELECT b.BNum,'Mamba' FROM beer b WHERE b.BeerName='Black Mamba' LIMIT 1);

-- bid- Sunny Day Porter
-- name- Day
INSERT INTO recipe (BNum,RName) (SELECT b.BNum,'Day' FROM beer b WHERE b.BeerName='Sunny Day Porter' LIMIT 1);

-- Recipe ingredient table
-- insert Mill Grain,Yeast,Orange Peel,sugar into DJ recipe
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Mill Grain' LIMIT 1),8
FROM recipe r
WHERE r.RName='Jazzy'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Yeast' LIMIT 1),4
FROM recipe r
WHERE r.RName='Jazzy'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Orange Peel' LIMIT 1),2
FROM recipe r
WHERE r.RName='Jazzy'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Black Tea' LIMIT 1),6
FROM recipe r
WHERE r.RName='Jazzy'
LIMIT 1;

-- Recipe ingredient table
-- insert Mill Grain,Yeast,Cinnamin Pie Spice, Spice into Black Mamba recipe

INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Mill Grain' LIMIT 1),8
FROM recipe r
WHERE r.RName='Mamba'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Yeast' LIMIT 1),4
FROM recipe r
WHERE r.RName='Mamba'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Pumpkin Pie Spice' LIMIT 1),2
FROM recipe r
WHERE r.RName='Mamba'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum FROM ingredient i WHERE i.InName='Spice' LIMIT 1),6
FROM recipe r
WHERE r.RName='Mamba'
LIMIT 1;

-- Recipe ingredient table
-- insert Mill Grain,Yeast,Spice,sugar into Big Bertha recipe

INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Mill Grain' LIMIT 1),8
FROM recipe r
WHERE r.RName='Bertha'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Yeast' LIMIT 1),4
FROM recipe r
WHERE r.RName='Bertha'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Spice' LIMIT 1),2
FROM recipe r
WHERE r.RName='Bertha'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Sugar' LIMIT 1),6
FROM recipe r
WHERE r.RName='Bertha'
LIMIT 1;

-- Recipe ingredient table
-- insert Mill Grain,Yeast,Orange Peel,Sugar into Sunny Day Porter recipe
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Mill Grain' LIMIT 1),8
FROM recipe r
WHERE r.RName='Day'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)  
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Yeast' LIMIT 1),4
FROM recipe r
WHERE r.RName='Day'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity)  
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Orange Peel' LIMIT 1),2
FROM recipe r
WHERE r.RName='Day'
LIMIT 1;
INSERT INTO recipe_ingredient (RNum,InNum,Quantity) 
SELECT r.RNum,(SELECT i.InNum AS inid FROM ingredient i WHERE i.InName='Sugar' LIMIT 1),6
FROM recipe r
WHERE r.RName='Day'
LIMIT 1;

-- Update entry from ingredient table
-- Update the Spice ingredient with new name Passion Flower
UPDATE ingredient SET InName='Passion Flower' WHERE InName='Spice';
