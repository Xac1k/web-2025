PROGRAM SarachReverHTML(INPUT, OUTPUT);
USES 
  GPC;
VAR
  Query : STRING;

BEGIN {PrintHello}
  WRITELN("Content-Type: text/plain");
  WRITELN;

  Query := GetEnv('QUERY_STRING');
  
  IF Query <> 'lantern=0'
  THEN
    BEGIN
      WRITE('The British are coming by ');

      IF Query = 'lantern=1'
      THEN
        WRITELN('land.');
      IF Query = 'lantern=2'
      THEN
        WRITELN('sea.')
    END
  ELSE
    WRITELN('Sarach don''t say.')
END. {PrintHello}

