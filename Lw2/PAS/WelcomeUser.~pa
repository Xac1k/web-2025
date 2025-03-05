PROGRAM WelcomeUser(INPUT, OUTPUT);
USES
  GPC;
VAR
  QueryString, User: STRING;
  PosUser: INTEGER;
BEGIN
  
  QueryString := GetEnv('QUERY_STRING');
  PosUser := Pos('name=', QueryString) + 5;
  
  User := Copy(QueryString, PosUser, Length(QueryString) + 1 - PosUser);
 
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITE('Hello dear, ');
  IF User <> ''
  THEN
    WRITELN(User,'!')
  ElSE
    WRITELN('Anonumus!')
END.
