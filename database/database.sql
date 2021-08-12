DROP DATABASE IF EXISTS abnorm_chat;

CREATE DATABASE abnorm_chat;

USE abnorm_chat;

CREATE TABLE message(
	id int auto_increment primary key,
    name varchar(255),
    message text,
    likes int default 0,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO message (name, message, likes, created_at) VALUES 
('Diego', 'Hey, how are you internet?', 3, now()  - INTERVAL 3 HOUR),
('Miriram', "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ullamcorper id lacus vitae mattis.
Donec scelerisque egestas lorem sit amet sollicitudin. Duis ut lobortis nibh, eu fringilla quam. 
Nam eget diam vitae turpis sollicitudin consectetur sit amet id magna. Maecenas imperdiet ex et elit suscipit, et posuere metus tempor. 
Nulla in tristique tellus, quis dapibus elit. Curabitur mattis dignissim ante ac eleifend. Duis sed augue vel sapien tincidunt facilisis. 
Pellentesque vitae elit laoreet eros accumsan congue non ac mi. Aliquam tempus nisi sit amet tortor efficitur, ut vulputate orci scelerisque.
Etiam laoreet vehicula mauris at pellentesque. Maecenas dapibus, massa eu fermentum rutrum, neque nibh tempor nisl, sit amet laoreet lacus metus consectetur nulla. 
Nam quis sem nulla. Suspendisse pulvinar scelerisque sem, nec bibendum arcu pellentesque ac. 
Vivamus viverra nunc maximus, porttitor arcu eu, vehicula augue. Integer congue quam at diam aliquam, id fringilla velit iaculis. 
Fusce scelerisque pharetra tortor, et gravida felis. Vivamus nisi diam, varius id ornare sit amet, ultricies nec dui. Praesent accumsan laoreet rhoncus. 
Cras ornare turpis odio, at ultrices ex aliquet eu. In hac habitasse platea dictumst.", 0, now() - INTERVAL 2 HOUR);


#Execute this INSERT before submitting your own message to test the "Only load new messages" functionality
#INSERT INTO message (name, message, likes, created_at) VALUES ('Albert', 'Test load new messages', 15, now()  - INTERVAL 1 HOUR);

#'Likes' works whit the same idea and it will show the total count of likes when you click 'like' or 'dislike'
#UPDATE message SET likes = (likes + 5) WHERE id = 2;

SELECT * FROM message ORDER BY created_at desc;